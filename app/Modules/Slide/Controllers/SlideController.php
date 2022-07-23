<?php

namespace App\Modules\Slide\Controllers;

use App\Http\Controllers\Admins\AdminController;
use App\Modules\Slide\Models\Slide;
use App\Modules\Slide\Requests\StoreRequest;
use App\Modules\Slide\Requests\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SlideController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = ['title' => 'Quản lý trình diễn ảnh'];
        if (isset($request->type) && $request->type != "" || isset($request->keyword)) {
            switch ($request->type) {
                case "all":
                    $data = array_merge($data, [
                        'slides' => Slide::select('id', 'images', 'title', 'id_user', 'is_active', 'created_at', 'link')->orderBy('id', 'DESC')->paginate(10)
                    ]);
                    break;
                case "status":
                    if ($request->keyword == "Inactive") {
                        $data = array_merge($data, [
                            'slides' => Slide::where('is_active', 0)->orderBy('id', 'DESC')->select('id', 'images', 'title', 'id_user', 'is_active', 'created_at', 'link')->paginate(10),
                        ]);
                    } elseif ($request->keyword == "Active") {
                        $data = array_merge($data, [
                            'slides' => Slide::where('is_active', 1)->orderBy('id', 'DESC')->select('id', 'images', 'title', 'id_user', 'is_active', 'created_at', 'link')->paginate(10),
                        ]);
                    } else {
                        if ($request->get('keyword') != 0) {
                            $data = array_merge($data, [
                                'slides' => Slide::where('title', 'like', '%' . $request->keyword . '%')->orderBy('id', 'DESC')->select('id', 'images', 'link', 'title', 'id_user', 'is_active', 'created_at')->paginate(10),
                            ]);
                        } else {
                            $data = array_merge($data, [
                                'slides' => Slide::orderBy('id', 'DESC')->select('id', 'images', 'title', 'link', 'id_user', 'is_active', 'created_at')->paginate(10),
                            ]);
                        }
                    }
                    break;
                case "author":
                    $data = array_merge($data, [
                        'slides' => Slide::join('users', 'users.id', '=', 'slides.id_user')
                            ->where('users.display_name', 'like', '%' . $request->keyword . '%')
                            ->orderBy('id', 'DESC')
                            ->select('slides.id', 'slides.images', 'slides.id_user', 'slides.is_active', 'slides.created_at', 'slides.link')
                            ->paginate(10),
                    ]);
                    break;
            }
        } else {
            $data = array_merge($data, [
                'slides' => Slide::select('id', 'images', 'title', 'link', 'id_user', 'is_active', 'created_at')->orderBy('id', 'DESC')->paginate(10)
            ]);
        }
        return view('Slide::list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ['title' => 'Thêm trình diễn ảnh mới'];
        return view('Slide::create')->with($data);
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
            $data = array_merge($request->only(['title', 'link']), [
                'images' => $this->getImages($request->get('images')),
                'id_user' => \Auth::user()->id
            ]);
            Slide::create($data);
            DB::commit();
            return redirect()->route('admin.slides.index')->with('success', 'Thêm trình diễn ảnh thành công !!!');
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
            'title' => 'Sửa trình diễn ảnh',
            'slide' => Slide::where('id', $id)->first()
        ];
        return view('Slide::edit')->with($data);
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
            $data = array_merge($request->only(['title', 'link']), [
                'images' => $this->getImages($request->get('images')),
            ]);
            Slide::where('id', $id)->update($data);
            DB::commit();
            return redirect()->route('admin.slides.index')->with('success', 'Cập nhật trình diễn ảnh thành công !!!');
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
            Slide::where('id', $id)->delete();
            DB::commit();
            return redirect()->route('admin.slides.index')->with('success', 'Xoá trình diễn ảnh thành công !!!');
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
            Slide::whereIn('id', $id)->delete();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Xoá trình diễn ảnh thành công !!!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi: ' . $e->getMessage()
            ]);
        }

    }
}
