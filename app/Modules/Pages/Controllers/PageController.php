<?php

namespace App\Modules\Pages\Controllers;

use App\Http\Controllers\Admins\AdminController;
use App\Http\Controllers\Controller;
use App\Modules\Pages\Models\Page;
use App\Modules\Pages\Requests\StoreRequest;
use App\Modules\Pages\Requests\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Str;

class PageController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = ['title' => 'Quản lý trang tĩnh'];
        if (isset($request->type) && $request->type != "" || isset($request->keyword)) {
            switch ($request->type) {
                case "all":
                    $data = array_merge($data, [
                        'pages' => Page::select('id', 'images', 'title', 'id_user', 'is_active', 'is_hot', 'created_at')->orderBy('id', 'DESC')->paginate(15)
                    ]);
                    break;
                case "title":
                    $data = array_merge($data, [
                        'pages' => Page::where('title', 'like', '%' . $request->keyword . '%')->orderBy('id', 'DESC')->select('id', 'images', 'title', 'id_user', 'is_active', 'is_hot', 'created_at')->paginate(15),
                    ]);
                    break;
                case "status":
                    if ($request->keyword == "Inactive") {
                        $data = array_merge($data, [
                            'pages' => Page::where('is_active', 0)->orderBy('id', 'DESC')->select('id', 'images', 'title', 'id_user', 'is_active', 'is_hot', 'created_at')->paginate(15),
                        ]);
                    } elseif ($request->keyword == "Active") {
                        $data = array_merge($data, [
                            'pages' => Page::where('is_active', 1)->orderBy('id', 'DESC')->select('id', 'images', 'title', 'id_user', 'is_active', 'is_hot', 'created_at')->paginate(15),
                        ]);
                    } else {
                        $data = array_merge($data, [
                            'pages' => Page::orderBy('id', 'DESC')->select('id', 'images', 'title', 'id_user', 'is_active', 'is_hot', 'created_at')->paginate(15),
                        ]);
                    }
                    break;
                case "featured":
                    if ($request->get('keyword') != 0) {
                        $data = array_merge($data, [
                            'pages' => Page::where('is_hot', 1)->where('title', 'like', '%' . $request->keyword . '%')->orderBy('id', 'DESC')->select('id', 'images', 'title', 'id_user', 'is_active', 'is_hot', 'created_at')->paginate(15),
                        ]);
                    }else{
                        $data = array_merge($data, [
                            'pages' => Page::where('is_hot', 1)->orderBy('id', 'DESC')->select('id', 'images', 'title', 'id_user', 'is_active', 'is_hot', 'created_at')->paginate(15),
                        ]);
                    }
                    break;
                case "author":
                    $data = array_merge($data, [
                        'pages' => Page::join('users', 'users.id', '=', 'pages.id_user')
                            ->where('users.display_name', 'like', '%' . $request->keyword . '%')
                            ->orderBy('id', 'DESC')
                            ->select('pages.id', 'pages.images', 'pages.title', 'pages.id_user', 'pages.is_active', 'pages.is_hot', 'pages.created_at')
                            ->paginate(15),
                    ]);
                    break;
            }
        } else {
            $data = array_merge($data, [
                'pages' => Page::select('id', 'images', 'title', 'id_user', 'is_active', 'is_hot', 'created_at')->orderBy('id', 'DESC')->paginate(15)
            ]);
        }
        return view('Pages::list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Thêm trang tĩnh mới'
        ];
        return view('Pages::create')->with($data);
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
            $data = array_merge($request->only(['title', 'content', 'overview', 'page_type']), [
                'slug' => Str::slug($request->get('title')),
                'images' => $this->getImages($request->get('images')),
                'id_user' => Auth::user()->id
            ]);
            Page::create($data);
            DB::commit();
            return redirect()->route('admin.pages.index')->with('success', 'Thêm trang tĩnh thành công !!!');
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
            'title' => 'Sửa trang tĩnh',
            'page' => Page::where('id', $id)->first()
        ];
        return view('Pages::edit')->with($data);
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
            $data = array_merge($request->only(['title', 'content',  'overview', 'page_type']), [
                'slug' => Str::slug($request->get('title')),
                'images' => $this->getImages($request->get('images')),
            ]);
            Page::where('id', $id)->update($data);
            DB::commit();
            return redirect()->route('admin.pages.index')->with('success', 'Cập nhật trang tĩnh thành công !!!');
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
            Page::where('id', $id)->delete();
            DB::commit();
            return redirect()->route('admin.pages.index')->with('success', 'Xoá trang tĩnh thành công !!!');
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
            Page::whereIn('id', $id)->delete();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Xoá trang tĩnh thành công !!!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi: ' . $e->getMessage()
            ]);
        }

    }
}
