<?php

namespace App\Modules\Menu\Controllers;

use App\Http\Controllers\Admins\AdminController;
use App\Modules\Menu\Models\Menu;
use App\Modules\Menu\Models\MenuPosition;
use App\Modules\Menu\Requests\Menu\StoreRequest;
use App\Modules\Menu\Requests\Menu\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [
            'title' => 'Quản lý menu',
            'positions' => MenuPosition::where('is_active', 1)->select('id', 'title')->get()
        ];
        if (isset($request->type) && $request->type != "" || isset($request->keyword)) {
            switch ($request->type) {
                case "all":
                    $data = array_merge($data, [
                        'menus' => Menu::select('id', 'title', 'id_position', 'is_active', 'created_at')->orderBy('id', 'DESC')->paginate(10)
                    ]);
                    break;
                case "title":
                    $data = array_merge($data, [
                        'menus' => Menu::where('title', 'like', '%' . $request->keyword . '%')->orderBy('id', 'DESC')->select('id', 'title', 'id_position', 'is_active', 'created_at')->paginate(10),
                    ]);
                    break;
                case "status":
                    if ($request->keyword == "Inactive") {
                        $data = array_merge($data, [
                            'menus' => Menu::where('is_active', 0)->orderBy('id', 'DESC')->select('id', 'title', 'id_position', 'is_active', 'created_at')->paginate(10),
                        ]);
                    } elseif ($request->keyword == "Active") {
                        $data = array_merge($data, [
                            'menus' => Menu::where('is_active', 1)->orderBy('id', 'DESC')->select('id', 'title', 'id_position', 'is_active', 'created_at')->paginate(10),
                        ]);
                    } else {
                        if ($request->get('keyword') != 0) {
                            $data = array_merge($data, [
                                'menus' => Menu::where('title', 'like', '%' . $request->keyword . '%')->orderBy('id', 'DESC')->select('id', 'title', 'id_position', 'is_active', 'created_at')->paginate(10),
                            ]);
                        } else {
                            $data = array_merge($data, [
                                'menus' => Menu::orderBy('id', 'DESC')->select('id', 'title', 'id_position', 'is_active', 'created_at')->paginate(10),
                            ]);
                        }
                    }
                    break;
            }
        } else {
            $data = array_merge($data, [
                'menus' => Menu::select('id', 'title', 'id_position', 'is_active', 'created_at')->orderBy('id', 'DESC')->paginate(10)
            ]);
        }
        return view('Menu::Menu.list')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->only(['title', 'id_position']);
            Menu::create($data);
            DB::commit();
            return redirect()->back()->with('success', 'Thêm menu mới thành công !!!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'title' => 'Sửa menu',
            'menu' => Menu::where('id', $id)->first(),
            'positions' => MenuPosition::where('is_active', 1)->select('id', 'title')->get()
        ];
        return view('Menu::Menu.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $data = $request->only(['title', 'id_position']);
            Menu::where('id', $id)->update($data);
            DB::commit();
            return redirect()->route('admin.menus.index')->with('success', 'Cập nhật menu thành công !!!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            Menu::where('id', $id)->delete();
            DB::commit();
            return redirect()->route('admin.menus.index')->with('success', 'Xoá menu thành công !!!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAll(Request $request)
    {
        try {
            $id = $request->get('id');
            DB::beginTransaction();
            Menu::whereIn('id', $id)->delete();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Xoá menu thành công !!!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi: ' . $e->getMessage()
            ]);
        }

    }
}
