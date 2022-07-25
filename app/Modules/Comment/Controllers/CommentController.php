<?php

namespace App\Modules\Comment\Controllers;

use App\Http\Controllers\Admins\AdminController;
use App\Http\Controllers\Controller;
use App\Modules\Blog\Models\Category;
use App\Modules\Comment\Models\Comment;
use App\Modules\Comment\Requests\Comment\StoreRequest;
use App\Modules\Product\Models\Product;
use App\Modules\User\Models\Actionhistoryuser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Auth;

class CommentController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = ['title' => 'Quản lý bình luận'];
        if (isset($request->type) && $request->type != "" || isset($request->keyword)) {
            switch ($request->type) {
                case "all":
                    $data = array_merge($data, [
                        'comments' => Comment::join('products','products.id','=','comments.comment_product_id')
                        ->select('comments.id', 'comments.title','comments.comment_product_id','comments.content', 'comments.images','comments.date','comments.is_active', 'comments.created_at','products.slug')->orderBy('comments.id', 'DESC')->paginate(10)
                    ]);
                    break;
                case "title":
                    $data = array_merge($data, [
                        'comments' => Comment::join('products','products.id','=','comments.comment_product_id')->where('comments.title', 'like', '%' . $request->keyword . '%')->orderBy('comments.id', 'DESC')->select('comments.id', 'comments.title','comments.comment_product_id','comments.content', 'comments.images','comments.date','comments.is_active', 'comments.created_at','products.slug')->paginate(10),
                    ]);
                    break;
                case "status":
                    if ($request->keyword == "Inactive") {
                        $data = array_merge($data, [
                            'comments' => Comment::join('products','products.id','=','comments.comment_product_id')->where('comments.is_active', 0)->orderBy('comments.id', 'DESC')->select('comments.id', 'comments.title','comments.comment_product_id','comments.content', 'comments.images','comments.date','comments.is_active', 'comments.created_at','products.slug')->paginate(10),
                        ]);
                    } elseif ($request->keyword == "Active") {
                        $data = array_merge($data, [
                            'comments' => Comment::join('products','products.id','=','comments.comment_product_id')->where('comments.is_active', 1)->orderBy('comments.id', 'DESC')->select('comments.id', 'comments.title','comments.comment_product_id','comments.content', 'comments.images','comments.date','comments.is_active', 'comments.created_at','products.slug')->paginate(10),
                        ]);
                    } else {
                        if ($request->get('keyword') != 0) {
                            $data = array_merge($data, [
                                'comments' => Comment::join('products','products.id','=','comments.comment_product_id')->where('comments.title', 'like', '%' . $request->keyword . '%')->orderBy('comments.id', 'DESC')->select('comments.id', 'comments.title','comments.comment_product_id','comments.content', 'comments.images','comments.date','comments.is_active', 'comments.created_at','products.slug')->paginate(10),
                            ]);
                        } else {
                            $data = array_merge($data, [
                                'comments' => Comment::join('products','products.id','=','comments.comment_product_id')->orderBy('comments.id', 'DESC')->select('comments.id', 'comments.title','comments.comment_product_id','comments.content', 'comments.images','comments.date','comments.is_active', 'comments.created_at','products.slug')->paginate(10),
                            ]);
                        }
                    }
                    break;
            }
        } else {
            $data = array_merge($data, [
                'comments' => Comment::join('products','products.id','=','comments.comment_product_id')
                    ->select('comments.id', 'comments.title','comments.comment_product_id','comments.content', 'comments.images','comments.date','comments.is_active', 'comments.created_at','products.slug')
                    ->orderBy('comments.id', 'DESC')->paginate(10)
            ]);
        }
        return view('Comment::comments.list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Thêm bài bình luận',

        ];
        return view('Comment::comments.create')->with($data);
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

            $data = array_merge($request->only(['title', 'content','date']), [
                'images' => $this->getImages($request->get('images')),
                'comment_product_id'=>($request->get('comment_product_id')),
                'id_user' => Auth::user()->id,

            ]);

            $Comment = Comment::create($data);
            $Comment->categories()->attach($request->get('category_id'));
            $Comment_id=$Comment->id;
            $history = array_merge($request->only(['users_id', 'type', 'work', 'content']), [
                'users_id' => \Auth::user()->id,
                'work' =>'Sửa bài viết',
                'type' => 'Comment',
                'content' =>($request->get('title')).'_id_ '.$Comment_id,
            ]);
            $historys = Actionhistoryuser::create($history);
            DB::commit();

            return redirect()->route('admin.comments.index')->with('success', 'Thêm bài bình luận thành công !!!');
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
            'title' => 'Sửa bình luận',
            'comment' => Comment::where('id', $id)->first(),
        ];
        return view('Comment::comments.edit')->with($data);
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
            $Comment = Comment::whereId($id)->first();
            $data = array_merge($request->only(['title', 'content', 'seo_title', 'seo_keyword', 'seo_description', 'overview']), [
                'slug' => Str::slug($request->get('title')),
                'images' => $this->getImages($request->get('images')),
            ]);
            $Comment->update($data);
            $Comment->categories()->sync($request->input('category_id'));
            $Comment_id=$Comment->id;
            $history = array_merge($request->only(['users_id', 'type', 'work', 'content']), [
                'users_id' => \Auth::user()->id,
                'work' =>'Sửa bài viết',
                'type' => 'Comment',
                'content' =>($request->get('title')).'_id_ '.$Comment_id,
            ]);
            $historys = Actionhistoryuser::create($history);
            DB::commit();
            return redirect()->route('admin.comments.index')->with('success', 'Cập nhật bài viết thành công !!!');
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
            $Comment=Comment::where('id', $id)->delete();
            $history =[
                'users_id' => \Auth::user()->id,
                'work' =>'Sửa bài viết',
                'type' => 'Comment',
                'content' =>$Comment->title.'_id_ '.$id,
            ];
            $historys = Actionhistoryuser::create($history);
            DB::commit();
            return redirect()->route('admin.comments.index')->with('success', 'Xoá bài viết thành công !!!');
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
            Comment::whereIn('id', $id)->delete();
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
