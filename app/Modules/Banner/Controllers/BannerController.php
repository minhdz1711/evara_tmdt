<?php

namespace App\Modules\Banner\Controllers;

use App\Http\Controllers\Admins\AdminController;
use App\Modules\Banner\Models\Banner;
use App\Modules\Banner\Requests\StoreRequest;
use App\Modules\Banner\Requests\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BannerController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = ['title' => 'Quản lý banner'];
        if (isset($request->type) && $request->type != "" || isset($request->keyword)) {
            switch ($request->type) {
                case "all":
                    $data = array_merge($data, [
                        'banners' => Banner::select('id', 'images', 'title', 'id_user', 'is_active', 'created_at', 'position', 'order')->orderBy('id', 'DESC')->paginate(15)
                    ]);
                    break;
                case "status":
                    if ($request->keyword == "Inactive") {
                        $data = array_merge($data, [
                            'banners' => Banner::where('is_active', 0)->orderBy('id', 'DESC')->select('order', 'position', 'id', 'images', 'title', 'id_user', 'is_active', 'created_at')->paginate(15),
                        ]);
                    } elseif ($request->keyword == "Active") {
                        $data = array_merge($data, [
                            'banners' => Banner::where('is_active', 1)->orderBy('id', 'DESC')->select('order', 'position', 'id', 'images', 'title', 'id_user', 'is_active', 'created_at')->paginate(15),
                        ]);
                    } else {
                        if ($request->get('keyword') != 0) {
                            $data = array_merge($data, [
                                'banners' => Banner::where('title', 'like', '%' . $request->keyword . '%')->orderBy('id', 'DESC')->select('order', 'position', 'id', 'images', 'title', 'id_user', 'is_active', 'created_at')->paginate(15),
                            ]);
                        } else {
                            $data = array_merge($data, [
                                'banners' => Banner::orderBy('id', 'DESC')->select('order', 'position', 'id', 'images', 'title', 'id_user', 'is_active', 'created_at')->paginate(15),
                            ]);
                        }
                    }
                    break;
                case "author":
                    $data = array_merge($data, [
                        'banners' => Banner::join('users', 'users.id', '=', 'banners.id_user')
                            ->where('users.display_name', 'like', '%' . $request->keyword . '%')
                            ->orderBy('id', 'DESC')
                            ->select('banners.id', 'banners.images', 'banners.id_user', 'banners.is_active', 'banners.created_at', 'banners.position', 'banners.order')
                            ->paginate(15),
                    ]);
                    break;
            }
        } else {
            $data = array_merge($data, [
                'banners' => Banner::select('order', 'position', 'id', 'images', 'title', 'id_user', 'is_active', 'created_at')->orderBy('id', 'DESC')->paginate(15)
            ]);
        }
        return view('Banner::list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ['title' => 'Thêm banner ảnh mới'];
        return view('Banner::create')->with($data);
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
            $data = array_merge($request->only(['title', 'link_banner', 'position', 'order']), [
                'images' => $this->getImages($request->get('images')),
                'id_user' => \Auth::user()->id
            ]);
            Banner::create($data);
            DB::commit();
            return redirect()->route('admin.banners.index')->with('success', 'Thêm banner thành công !!!');
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
            'title' => 'Sửa banner',
            'banner' => Banner::where('id', $id)->first()
        ];
        return view('Banner::edit')->with($data);
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
            $data = array_merge($request->only(['title', 'link_banner', 'position', 'order']), [
                'images' => $this->getImages($request->get('images')),
            ]);
            Banner::where('id', $id)->update($data);
            DB::commit();
            return redirect()->route('admin.banners.index')->with('success', 'Cập nhật banner thành công !!!');
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
            Banner::where('id', $id)->delete();
            DB::commit();
            return redirect()->route('admin.banners.index')->with('success', 'Xoá banner thành công !!!');
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
            Banner::whereIn('id', $id)->delete();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Xoá banner thành công !!!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi: ' . $e->getMessage()
            ]);
        }

    }
}
