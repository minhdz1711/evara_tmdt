<?php

namespace App\Modules\Post\Controllers;

use App\Http\Controllers\Admins\AdminController;
use App\Modules\Blog\Models\Category;
use App\Modules\Post\Requests\Category\StoreRequest;
use App\Modules\Post\Requests\Category\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [
            'title' => 'Quản lý danh mục bài viết',
            'parents' => Category::where([['is_active', 1], ['cat_type', 'post']])->select('id', 'title', 'parent_id')->get()
        ];
        if (isset($request->type) && $request->type != "" || isset($request->keyword)) {
            switch ($request->type) {
                case "title":
                    $data = array_merge($data, [
                        'post_categories' => Category::where([['title', 'like', '%' . $request->keyword . '%'], ['cat_type', 'post']])->orderBy('id', 'DESC')->select('id', 'title', 'is_active', 'is_hot', 'is_home', 'parent_id')->paginate(15),
                    ]);
                    break;
                case "status":
                    if ($request->keyword == "Inactive") {
                        $data = array_merge($data, [
                            'post_categories' => Category::where([['is_active', 0], ['cat_type', 'post']])->orderBy('id', 'DESC')->select('id', 'title', 'is_active', 'is_hot', 'is_home', 'parent_id')->paginate(15),
                        ]);
                    } elseif ($request->keyword == "Active") {
                        $data = array_merge($data, [
                            'post_categories' => Category::where([['is_active', 0], ['cat_type', 'post']])->orderBy('id', 'DESC')->select('id', 'title', 'is_active', 'is_hot', 'is_home', 'parent_id')->paginate(15),
                        ]);
                    } else {
                        $data = array_merge($data, [
                            'post_categories' => Category::where('cat_type', 'post')->select('id', 'title', 'is_active', 'is_hot', 'is_home', 'parent_id')->orderBy('id', 'DESC')->paginate(15),
                        ]);
                    }
                    break;
                case "all":
                    $data = array_merge($data, [
                        'post_categories' => Category::where('cat_type', 'post')->select('id', 'title', 'is_active', 'is_hot', 'is_home', 'parent_id')->orderBy('id', 'DESC')->paginate(15),
                    ]);
                    break;
            }
        } else {
            $data = array_merge($data, ['post_categories' => Category::where('cat_type', 'post')->select('id', 'title', 'is_active', 'is_hot', 'is_home', 'parent_id')->orderBy('id', 'DESC')->paginate(15)]);
        }
        return view('Post::Category.list')->with($data);
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
            $data = array_merge($request->only(['title', 'overview', 'parent_id']), [
                'slug' => Str::slug($request->get('title')),
                'cat_type' => 'post'
            ]);
            $category = Category::create($data);
            Category::where('id', $category->id)->update(['slug' => Str::slug($request->get('title')) . '-' . $category->id]);
            DB::commit();
            return redirect()->back()->with('success', 'Thêm danh mục thành công !!!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '"Lỗi: ' . $e->getMessage() . '"');
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
            'category' => Category::where('id', $id)->first(),
            'title' => 'Sửa danh mục',
            'parents' => Category::where([['is_active', 1], ['cat_type', 'post']])->select('id', 'title', 'parent_id')->get()
        ];

        return view('Post::category.edit')->with($data);
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
            $data = array_merge($request->only(['title', 'overview', 'parent_id']), [
                'slug' => Str::slug($request->get('title')) . '-' . $id,
                'cat_type' => 'post'
            ]);
            if ($request->get('parent_id') == $id) {
                return redirect()->back()->with('error', 'Danh mục cha bạn chọn đang là chính nó !!!');
            } else {
                if ($request->get('parent_id') != 0) {
                    $parent = Category::where('id', $request->get('parent_id'))->select('parent_id')->first();
                    if ($parent->parent_id != $id) {
                        Category::where('id', $id)->update($data);
                        DB::commit();
                        return redirect()->route('admin.post-categories.index')->with('success', 'Cập nhật danh mục thành công !!!');
                    } else {
                        return redirect()->back()->with('error', 'Danh mục cha bạn chọn đang là danh mục con của danh đang chỉnh sửa !!!');
                    }
                } else {
                    Category::where('id', $id)->update($data);
                    DB::commit();
                    return redirect()->route('admin.post-categories.index')->with('success', 'Cập nhật danh mục thành công !!!');
                }
            }
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
            Category::where('id', $id)->delete();
            Category::where('parent_id', $id)->update(['parent_id' => 0]);
            DB::commit();
            return redirect()->route('admin.post-categories.index')->with('success', 'Xoá danh mục thành công !!!');
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
            Category::whereIn('id', $id)->delete();
            Category::whereIn('parent_id', $id)->update(['parent_id' => 0]);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Xoá danh mục thành công !!!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi: ' . $e->getMessage()
            ]);
        }

    }
}
