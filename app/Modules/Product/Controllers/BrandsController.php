<?php

namespace App\Modules\Product\Controllers;

use App\Http\Controllers\Admins\AdminController;
use App\Http\Controllers\Controller;
use App\Modules\Product\Models\Brands;
use App\Modules\Category\Requests\Category\StoreRequest;
use App\Modules\Category\Requests\Category\UpdateRequest;
use Illuminate\Http\Request;
//use App\Modules\User\Models\Actionhistoryuser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandsController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [
            'title' => 'Quản lý Thương Hiệu',
            'parents' => Brands::select('id', 'title', 'parent_id')->get()
        ];

        if (isset($request->type) && $request->type != "" || isset($request->keyword)) {
            switch ($request->type) {
                case "title":
                    $data = array_merge($data, [
                        'categories' => Brands::where([['title', 'like', '%' . $request->keyword . '%']])->orderBy('id', 'DESC')->select('id', 'title', 'is_active')->paginate(10),
                    ]);
                    break;
                case "status":
                    if ($request->keyword == "Inactive") {
                        $data = array_merge($data, [
                            'categories' => Brands::where([['is_active', 0]])->orderBy('id', 'DESC')->select('id', 'title', 'is_active')->paginate(10),
                        ]);
                    } elseif ($request->keyword == "Active") {
                        $data = array_merge($data, [
                            'categories' => Brands::where([['is_active', 0]])->orderBy('id', 'DESC')->select('id', 'title', 'is_active')->paginate(10),
                        ]);
                    } else {
                        $data = array_merge($data, [
                            'categories' => Brands::where('is_active', '1')->select('id', 'title', 'is_active')->orderBy('id', 'DESC')->paginate(10),
                        ]);
                    }
                    break;
                case "all":
                    $data = array_merge($data, [
                        'categories' => Brands::where('is_active', '1')->select('id', 'title', 'is_active')->orderBy('id', 'DESC')->paginate(10),
                    ]);
                    break;
            }
        } else {

            $data = array_merge($data, ['categories' => Brands::select('id', 'images', 'title', 'is_active', 'parent_id')->orderBy('id', 'DESC')->paginate(10)]);
        }


        return view('Product::Brands.list')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {


        try {
            DB::beginTransaction();
            $data = array_merge($request->only(['title', 'parent_id']), [
                'slug' => Str::slug($request->get('title', 'parent_id')),
                'sku' => 'title',
                'images' => $this->getImages($request->get('images'))
            ]);
            $category = Brands::create($data);
            Brands::where('id', $category->id)->update(['slug' => Str::slug($request->get('title'))]);
            DB::commit();
            return redirect()->back()->with('success', 'Thêm thương hiệu thành công !!!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data = [
            'category' => Brands::where('id', $id)->first(),
            'title' => 'Sửa danh mục',
            'parents' => Brands::where([['is_active', 1]])->select('id', 'title', 'overview')->get()
        ];

        return view('Product::Brands.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {


        try {
            DB::beginTransaction();
            $data = array_merge($request->only(['title', 'overview', 'parent_id']), [
                'slug' => Str::slug($request->get('title')) . '-' . $id,
                'images' => $this->getImages($request->get('images'))
            ]);
            if ($request->get('parent_id') == $id) {
                return redirect()->back()->with('error', 'Danh mục cha bạn chọn đang là chính nó !!!');
            } else {
                if ($request->get('parent_id') != 0) {
                    $parent = Brands::where('id', $request->get('parent_id'))->select('parent_id')->first();
                    if ($parent->parent_id != $id) {
                        Brands::where('id', $id)->update($data);
                        $history = array_merge($request->only(['users_id', 'type', 'work', 'content']), [
                            'users_id' => \Auth::user()->id,
                            'work' => 'Sửa thương hiệu',
                            'type' => 'Brands',
                            'content' => ($request->get('title')) . '_id_ ' . $id,
                        ]);
                        $historys = Actionhistoryuser::create($history);
                        DB::commit();
                        return redirect()->route('admin.brands.index')->with('success', 'Cập nhật thương hiệu thành công !!!');
                    } else {
                        return redirect()->back()->with('error', 'Danh mục cha bạn chọn đang là danh mục con của danh đang chỉnh sửa !!!');
                    }
                } else {
                    Brands::where('id', $id)->update($data);
                    DB::commit();
                    return redirect()->route('admin.brands.index')->with('success', 'Cập nhật thương hiệu thành công !!!');
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            DB::beginTransaction();
            Brands::where('id', $id)->delete();
            Brands::where('parent_id', $id)->update(['parent_id' => 0]);
            DB::commit();
            return redirect()->route('admin.brands.index')->with('success', 'Xoá thương hiệu thành công !!!');
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
            Brands::whereIn('id', $id)->delete();
            Brands::whereIn('parent_id', $id)->update(['parent_id' => 0]);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Xoá thương hiệu thành công !!!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi: ' . $e->getMessage()
            ]);
        }

    }
}
