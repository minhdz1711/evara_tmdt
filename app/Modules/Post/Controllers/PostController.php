<?php

namespace App\Modules\Post\Controllers;

use App\Http\Controllers\Admins\AdminController;
use App\Http\Controllers\Controller;
use App\Modules\Blog\Models\Category;
use App\Modules\Post\Models\Post;
use App\Modules\Post\Requests\Post\StoreRequest;
use App\Modules\Post\Requests\Post\UpdateRequest;
use App\Modules\Product\Models\Product;
use App\Modules\User\Models\Actionhistoryuser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Auth;
use phpDocumentor\Reflection\Types\Null_;

class PostController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = ['title' => 'Quản lý bài viết'];
        if (isset($request->type) && $request->type != "" || isset($request->keyword)) {
            switch ($request->type) {
                case "all":
                    $data = array_merge($data, [
                        'posts' => Post::select('id', 'images', 'title','view','is_sort', 'id_user','is_index','cate_product_id','id_tag', 'is_active', 'is_hot', 'created_at')->orderBy('id', 'DESC')->paginate(10)
                    ]);
                    break;
                case "title":
                    $data = array_merge($data, [
                        'posts' => Post::where('title', 'like', '%' . $request->keyword . '%')->orderBy('id', 'DESC')->select('id', 'images', 'title','view','is_sort', 'id_user','is_index','cate_product_id','id_tag', 'is_active', 'is_hot', 'created_at')->paginate(10),
                    ]);
                    break;
                case "status":
                    if ($request->keyword == "Inactive") {
                        $data = array_merge($data, [
                            'posts' => Post::where('is_active', 0)->orderBy('id', 'DESC')->select('id', 'images', 'title','is_active','view','is_sort', 'id_user','is_index','cate_product_id','id_tag', 'is_hot', 'created_at')->paginate(10),
                        ]);
                    } elseif ($request->keyword == "Active") {
                        $data = array_merge($data, [
                            'posts' => Post::where('is_active', 1)->orderBy('id', 'DESC')->select('id', 'images', 'title','is_active','view','is_sort', 'id_user','is_index','cate_product_id','id_tag', 'is_hot', 'created_at')->paginate(10),
                        ]);
                    } else {
                        if ($request->get('keyword') != 0) {
                            $data = array_merge($data, [
                                'posts' => Post::where('title', 'like', '%' . $request->keyword . '%')->orderBy('id', 'DESC')->select('id', 'images', 'title','is_active','view','is_sort', 'id_user','is_index','cate_product_id','id_tag', 'is_hot', 'created_at')->paginate(10),
                            ]);
                        } else {
                            $data = array_merge($data, [
                                'posts' => Post::orderBy('id', 'DESC')->select('id', 'images', 'title','is_active','view','is_sort', 'id_user','is_index','cate_product_id','id_tag', 'is_hot', 'created_at')->paginate(10),
                            ]);
                        }
                    }
                    break;
                case "featured":
                    $data = array_merge($data, [
                        'posts' => Post::where('is_hot', 1)->where('title', 'like', '%' . $request->keyword . '%')->orderBy('id', 'DESC')->select('id', 'images', 'title','is_active','view','is_sort', 'id_user','is_index','cate_product_id','id_tag', 'is_hot', 'created_at')->paginate(10),
                    ]);
                    break;
                case "author":
                    $data = array_merge($data, [
                        'posts' => Post::join('users', 'users.id', '=', 'posts.id_user')
                            ->where('users.display_name', 'like', '%' . $request->keyword . '%')
                            ->orderBy('id', 'DESC')
                            ->select('posts.id', 'posts.images', 'posts.title', 'posts.id_user', 'posts.is_active', 'posts.is_hot', 'posts.created_at')
                            ->paginate(10),
                    ]);
                    break;
            }
        } else {
            $data = array_merge($data, [
                'posts' => Post::select('id', 'images', 'title','is_active','view','is_sort', 'id_user','is_index','cate_product_id','id_tag', 'is_hot', 'created_at')->orderBy('id', 'DESC')->paginate(10)
            ]);
        }
        return view('Post::posts.list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Thêm bài viết mới',
            'post_categories' => Category::where([['is_active', 1], ['cat_type', 'post']])->select('id', 'title', 'parent_id')->get(),
            'product_categories' => Category::where([['is_active', 1], ['cat_type', 'product']])->select('id', 'title','parent_id')->get(),

        ];
        return view('Post::posts.create')->with($data);
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

            $data = array_merge($request->only(['title', 'content', 'overview']), [
                'slug' => Str::slug($request->get('title')),
                'images' => $this->getImages($request->get('images')),
                'cate_product_id'=>($request->get('product_category_id')!="")? implode('|',$request->get('product_category_id')) :NULL,
//                'id_tag' => ($request->get('tag_id')!="")? implode($request->get('tag_id')):NULL,
                'id_user' => Auth::user()->id,
                'view'=>0

            ]);

            $post = Post::create($data);
            $post->categories()->attach($request->get('post_category_id'));
            $post_id=$post->id;
            $history = array_merge($request->only(['users_id', 'type', 'work', 'content']), [
                'users_id' => \Auth::user()->id,
                'work' =>'Sửa bài viết',
                'type' => 'post',
                'content' =>($request->get('title')).'_id_ '.$post_id,
            ]);
            $historys = Actionhistoryuser::create($history);
            DB::commit();

            return redirect()->route('admin.posts.index')->with('success', 'Thêm bài viết mới thành công !!!');
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
        $category = DB::table('category_post')->where('post_id', $id)->get();
        foreach ($category as $cate) {
            $args[] = $cate->category_id;
        }
        $data = [
            'title' => 'Sửa bài viết',
            'post' => Post::where('id', $id)->first(),
            'post_categories' => Category::where([['is_active', 1], ['cat_type', 'post']])->select('id', 'title', 'parent_id')->get(),
            'arg_id' => (!empty($args)) ? $args : []
        ];
        return view('Post::posts.edit')->with($data);
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
            $post = Post::whereId($id)->first();
            $data = array_merge($request->only(['title', 'content', 'overview']), [
                'slug' => Str::slug($request->get('title')),
                'images' => $this->getImages($request->get('images')),
            ]);
            $post->update($data);
            $post->categories()->sync($request->input('post_category_id'));
            $post_id=$post->id;
            $history = array_merge($request->only(['users_id', 'type', 'work', 'content']), [
                'users_id' => \Auth::user()->id,
                'work' =>'Sửa bài viết',
                'type' => 'post',
                'content' =>($request->get('title')).'_id_ '.$post_id,
            ]);
            $historys = Actionhistoryuser::create($history);
            DB::commit();
            return redirect()->route('admin.posts.index')->with('success', 'Cập nhật bài viết thành công !!!');
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
            $post=Post::where('id', $id)->delete();
            $history =[
                'users_id' => \Auth::user()->id,
                'work' =>'Xóa bài viết',
                'type' => 'post',
                'content' =>$post->title.'_id_ '.$id,
            ];
            $historys = Actionhistoryuser::create($history);
            DB::commit();
            return redirect()->route('admin.posts.index')->with('success', 'Xoá bài viết thành công !!!');
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
            Post::whereIn('id', $id)->delete();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Xoá bài viết thành công !!!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi: ' . $e->getMessage()
            ]);
        }

    }
}
