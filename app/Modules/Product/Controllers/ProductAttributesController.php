<?php

namespace App\Modules\Product\Controllers;

use App\Http\Controllers\Admins\AdminController;
use App\Http\Controllers\Controller;
use App\Modules\Product\Models\ProductAttribute;
use App\Modules\User\Models\Actionhistoryuser;
use App\Modules\Category\Models\Category;
use App\Modules\Product\Requests\Attributes\StoreRequest;
use App\Modules\Product\Requests\Attributes\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class  ProductAttributesController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data = [
            'title' => 'Thuộc tính sản phẩm',
            'attributes' => ProductAttribute::select('id', 'title', 'is_active')->get(),
            'parents' => Category::where([['is_active', 1], ['cat_type', 'product']])->select('id', 'title', 'parent_id')->get()
        ];
        if (isset($request->type) && $request->type != "" || isset($request->keyword)) {

            switch ($request->type) {

                case "title":
                    $data = array_merge($data, [
                        'product' => Category::where([['is_active', 1], ['cat_type', 'product']])->pluck('title', 'id')->all(),
                        'attributes' => ProductAttribute::where([['title', 'like', '%' . $request->keyword . '%']])->orderBy('id', 'DESC')->select('id', 'title', 'is_active', 'is_hot', 'is_home', 'parent_id')->paginate(10),
                    ]);

                    break;
                case "status":
                    if ($request->keyword == "Inactive") {
                        $data = array_merge($data, [
                            'product' => Category::where([['is_active', 1], ['cat_type', 'product']])->pluck('title', 'id')->all(),
                            'attributes' => ProductAttribute::where(['is_active', 0])->orderBy('id', 'DESC')->select('id', 'title', 'is_active')->paginate(10),
                        ]);
                    } elseif ($request->keyword == "Active") {
                        $data = array_merge($data, [
                            'attributes' => Category::where(['is_active', 0], ['cat_type', 'product'])->orderBy('id', 'DESC')->select('id', 'title', 'is_active')->paginate(10),
                        ]);
                    } else {
                        $data = array_merge($data, [
                            'product' => Category::where([['is_active', 1], ['cat_type', 'product']])->pluck('title', 'id')->all(),
                            'attributes' => ProductAttribute::select('id', 'title', 'is_active')->orderBy('id', 'DESC')->paginate(15),
                        ]);
                    }
                    break;
                case "all":
                    $data = array_merge($data, [
                        'product' => Category::where([['is_active', 1], ['cat_type', 'product']])->pluck('title', 'id')->all(),
                        'attributes' => ProductAttribute::where('is_active')->select('id', 'title', 'is_active', 'is_hot', 'is_home', 'parent_id')->orderBy('id', 'DESC')->paginate(10),
                    ]);
                    break;
            }
        } else {
            $data = array_merge($data,

                ['product' => Category::where([['is_active', 1], ['cat_type', 'product']])->select('title', 'id')->get(),
                    'parents' => Category::where([['is_active', 1], ['cat_type', 'product']])->select('id', 'title', 'parent_id')->get(),
                    'attributes' => ProductAttribute::select('id', 'title', 'is_active', 'product_attributes')->orderBy('id', 'DESC')->paginate(10)

                ]);

//            foreach $data($attributes as $it){
//                $it->cat_name = Categories::whereRaw('JSON_CONTAINS(id,\'["' . $it->id . '"]\')')->pluck('name');
//            }
        }


        return view('Product::Attributes.list')->with($data);
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
            $data = array_merge($request->only(['title', 'overview']), [
                'slug' => Str::slug($request->get('title')),
                'product_attributes' => implode('|', $request->get('product')),
            ]);
            $category = ProductAttribute::create($data);
//            $category->categories()->attach($request->get('product_attributes_id'));
            ProductAttribute::where('id', $category->id)->update(['slug' => Str::slug($request->get('title')) . '-' . $category->id]);
            $categorys_id = $category->id;
            $history = array_merge($request->only(['users_id', 'type', 'work', 'content']), [
                'users_id' => \Auth::user()->id,
                'work' => 'thêm thuộc tính',
                'type' => 'Attributes',
                'content' => ($request->get('title')) . '_id_ ' . $categorys_id,
            ]);
            $historys = Actionhistoryuser::create($history);
            DB::commit();

            return redirect()->back()->with('success', 'Thêm thuộc tính thành công !!!');
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
            'productss' => Category::where([['is_active', 1], ['cat_type', 'product']])->select('title', 'id')->get(),
            'attributes' => ProductAttribute::where('id', $id)->first(),
            'title' => 'Sửa danh mục',
            'categor2y' => Category::where([['is_active', 1], ['cat_type', 'product']])->select('id', 'title', 'parent_id')->get()
        ];
        return view('Product::Attributes.edit')->with($data);
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
            $product = ProductAttribute::whereId($id)->first();
            $data = array_merge($request->only(['title', 'overview']), [
                'slug' => Str::slug($request->get('title')) . '-' . $id,
                'overview' => $request->get('overview'),
                'product_attributes' => implode('|', $request->get('product')),

            ]);
            $product->update($data);
            $history = array_merge($request->only(['users_id', 'type', 'work', 'content']), [
                'users_id' => \Auth::user()->id,
                'work' => 'Sửa thuộc tính',
                'type' => 'Attributes',
                'content' => ($request->get('title')) . '_id_ ' . $id,
            ]);
            $historys = Actionhistoryuser::create($history);
            DB::commit();
            return redirect()->route('admin.product-attributes.index')->with('success', 'Cập nhật thuộc tính thành công !!!');

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
            $Product = ProductAttribute::where('id', $id)->first();
            $history = [
                'users_id' => \Auth::user()->id,
                'work' => 'xóa thuộc tính',
                'type' => 'Attributes',
                'content' => $Product->title . '_id_ ' . $id,
            ];
            $historys = Actionhistoryuser::create($history);
            ProductAttribute::where('id', $id)->delete();

            DB::commit();
            return redirect()->route('admin.product-attributes.index')->with('success', 'Xoá thuộc tính thành công !!!');
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
            ProductAttribute::whereIn('id', $id)->delete();
//            Attributes::whereIn('parent_id', $id)->update(['parent_id' => 0]);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Xoá thuộc tính thành công !!!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi: ' . $e->getMessage()
            ]);
        }

    }
}
