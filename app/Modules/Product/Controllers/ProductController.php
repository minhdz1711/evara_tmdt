<?php

namespace App\Modules\Product\Controllers;

use App\Http\Controllers\Admins\AdminController;
use App\Modules\Category\Models\Category;
use App\Modules\Product\Models\Brands;
use App\Modules\Product\Models\Product;
use App\Modules\Product\Models\ProductAttribute;
use App\Modules\Product\Models\ProductAttributeData;
use App\Modules\Product\Models\ProductGallery;
use App\Modules\Product\Requests\StoreRequest;
use App\Modules\Product\Requests\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Modules\User\Models\Actionhistoryuser;
use App\Modules\Product\Models\AttributesValue;


class ProductController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = ['title' => 'Quản lý sản phẩm'];
        if (isset($request->type) && $request->type != "" || isset($request->keyword)) {
            switch ($request->type) {
                case "all":
                    $data = array_merge($data, [
                        'products' => Product::select('id', 'images', 'title', 'id_user', 'is_active', 'is_hot', 'regular_price', 'sale_price', 'created_at',  'quantity', 'view', 'number_sell', 'slug', 'brands_id')->orderBy('id', 'DESC')->paginate(10)
                    ]);
                    break;
                case "title":
                    $data = array_merge($data, [
                        'products' => Product::where('title', 'like', '%' . $request->keyword . '%')->orderBy('id', 'DESC')->select('id', 'images', 'title', 'id_user', 'is_active', 'is_hot', 'regular_price', 'sale_price', 'created_at', 'quantity', 'view', 'number_sell', 'slug', 'brands_id')->paginate(10),
                    ]);
                    break;
                case "status":
                    if ($request->keyword == "Inactive") {
                        $data = array_merge($data, [
                            'products' => Product::where('is_active', 0)->orderBy('id', 'DESC')->select('id', 'images', 'title', 'id_user', 'is_active', 'is_hot', 'regular_price', 'sale_price', 'created_at', 'quantity', 'view', 'number_sell', 'slug', 'brands_id')->paginate(10),
                        ]);
                    } elseif ($request->keyword == "Active") {
                        $data = array_merge($data, [
                            'products' => Product::where('is_active', 1)->orderBy('id', 'DESC')->select('id', 'images', 'title', 'id_user', 'is_active', 'is_hot', 'regular_price', 'sale_price', 'created_at', 'quantity', 'view', 'number_sell', 'slug', 'brands_id')->paginate(10),
                        ]);
                    } else {
                        if ($request->get('keyword') != 0) {
                            $data = array_merge($data, [
                                'products' => Product::where('title', 'like', '%' . $request->keyword . '%')->orderBy('id', 'DESC')->select('id', 'images', 'title', 'id_user', 'is_active', 'is_hot', 'regular_price', 'sale_price', 'created_at',  'quantity', 'view', 'number_sell', 'slug', 'brands_id')->paginate(10),
                            ]);
                        } else {
                            $data = array_merge($data, [
                                'products' => Product::orderBy('id', 'DESC')->select('id', 'images', 'title', 'id_user', 'is_active', 'is_hot', 'regular_price', 'sale_price', 'created_at', 'quantity', 'view', 'number_sell', 'slug', 'brands_id')->paginate(10),
                            ]);
                        }
                    }
                    break;
                case "featured":
                    $data = array_merge($data, [
                        'products' => Product::where('is_hot', 1)->where('title', 'like', '%' . $request->keyword . '%')->orderBy('id', 'DESC')->select('id', 'images', 'title', 'id_user', 'is_active', 'is_hot', 'regular_price', 'sale_price', 'created_at', 'quantity', 'view', 'number_sell', 'slug', 'brands_id')->paginate(10),
                    ]);
                    break;
                case "author":
                    $data = array_merge($data, [
                        'products' => Product::join('users', 'users.id', '=', 'products.id_user')
                            ->where('users.display_name', 'like', '%' . $request->keyword . '%')
                            ->orderBy('id', 'DESC')
                            ->select('products.id', 'products.images', 'products.title', 'products.id_user', 'products.is_active', 'products.is_hot', 'products.regular_price', 'products.sale_price', 'products.created_at', 'quantity', 'view', 'number_sell', 'slug', 'brands_id')
                            ->paginate(10),
                    ]);
                    break;
            }
        } else {
            $data = array_merge($data, [
                'products' => Product::select('products.id', 'products.images', 'products.title', 'products.id_user', 'products.is_active', 'products.is_hot', 'products.regular_price', 'products.sale_price', 'products.created_at', 'quantity', 'view', 'number_sell', 'slug', 'brands_id')->orderBy('id', 'DESC')->paginate(10)
            ]);
        }
        return view('Product::Product.list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Thêm sản phẩm mới',
            'parents' => Brands::where([['is_active', 1]])->select('id', 'title', 'parent_id')->get(),
            'categories' => Category::where([['is_active', 1], ['cat_type', 'product']])->select('id', 'title', 'parent_id')->get()
        ];
        return view('Product::Product.create')->with($data);
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

            $sale_prices = 0;
            $regular_price = str_replace([',', '.', ''], '', $request->get('regular_price'));
            $sale_price = ($request->get('sale_price') != "") ? str_replace([',', '.', ''], '', $request->get('sale_price')) : ($sale_prices);
            if ($sale_price > $regular_price) {
                $sale_price = 0;
            }
            $data = array_merge($request->only(['title', 'quantity', 'brands_id', 'number_sell', 'order', 'content', 'overview', 'seo_title', 'seo_description', 'seo_keyword', 'sku', 'link_view']), [
                'slug' => Str::slug($request->get('title')),
                'images' => $this->getImages($request->get('images')),
                'id_user' => \Auth::user()->id,
                'regular_price' => $regular_price,
                'sale_price' => $sale_price
//                'sale_price' => ($request->get('sale_price') != "") ? $request->get('sale_price') : 0
            ]);
            $product = Product::create($data);
                // xử lý ảnh
            $pro_image = $request->get('pro_image');
            if (isset($product->id)) {
                foreach ($images as $key => $imageData) {
                    $patch = public_path('userfiles/images/');
//                    $data = 'data:image/png;base64,AAAFBfj42Pj4';
                    list($type, $imageData) = explode(';', $imageData);
                    list(, $extension) = explode('/', $type);
                    list(, $imageData) = explode(',', $imageData);
                    $fileName = uniqid() . '.' . $extension;
                    $imageData = base64_decode($imageData);
                    file_put_contents($patch . $fileName, $imageData);

                    if ($key == 0) {
                        $product->pro_image = 'userfiles/images/' . $fileName;
                        $product->update();
                    }
//
                }
            }

            $product_id = $product->id;
            if ($request->get('category_id')) {
                $product->categories()->attach($request->get('category_id'));
            }

            $history = array_merge($request->only(['users_id', 'type', 'work', 'content']), [
                'users_id' => \Auth::user()->id,
                'work' => 'thêm sản phẩm',
                'type' => 'product',
                'content' => ($request->get('title')) . '_id_ ' . $product_id,
            ]);
            $historys = Actionhistoryuser::create($history);
            DB::commit();
            return redirect()->route('admin.product.properties', $product_id)->with('success', 'Thêm sản phẩm thành công !!!');
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
        $categories = DB::table('category_product')->where('product_id', $id)->get();
        foreach ($categories as $category) {
            $args[] = $category->category_id;
        }
        $data = [
            'title' => 'Sửa sản phẩm',
            'product' => Product::where('id', $id)->first(),
            'brand' => DB::table('products')->join('product_brands', 'products.brands_id', '=', 'product_brands.id')->first(),
            'parents' => Brands::where([['is_active', 1]])->select('id', 'title', 'parent_id')->get(),
            'categories' => Category::where([['is_active', 1], ['cat_type', 'product']])->select('id', 'title', 'parent_id')->get(),
            'arg_id' => (!empty($args)) ? $args : []
        ];
        return view('Product::Product.edit')->with($data);
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
            $product = Product::whereId($id)->first();
            $data = array_merge($request->only(['title', 'quantity', 'content', 'overview', 'sku', 'link_view']), [
                'slug' => Str::slug($request->get('title')),
                'images' => $this->getImages($request->get('images')),
                'id_user' => \Auth::user()->id,
                'brands_id' => ($request->get('brands_id')),
                'regular_price' => ($request->get('regular_price') != "") ? $request->get('regular_price') : 0,
                'sale_price' => ($request->get('sale_price') != "") ? $request->get('sale_price') : 0
            ]);
            $product->update($data);
            $product->categories()->sync($request->input('category_id'));
            $product_id = $product->id;
            $history = array_merge($request->only(['users_id', 'type', 'work', 'content']), [
                'users_id' => \Auth::user()->id,
                'work' => 'Sửa sản phẩm',
                'type' => 'product',
                'content' => ($request->get('title')) . '_id_ ' . $product_id,
            ]);
            $historys = Actionhistoryuser::create($history);
            DB::commit();
            return redirect()->route('admin.products.index')->with('success', 'Cập nhật sản phẩm thành công !!!');
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
            $product = Product::where('id', $id)->delete();
            $history = [
                'users_id' => \Auth::user()->id,
                'work' => 'Xóa sản phẩm',
                'type' => 'product',
                'content' => $product->title . '_id_ ' . $id,
            ];
            $historys = Actionhistoryuser::create($history);
            DB::commit();
            return redirect()->route('admin.products.index')->with('success', 'Xoá sản phẩm thành công !!!');
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
            Product::whereIn('id', $id)->delete();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Xoá sản phẩm thành công !!!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi: ' . $e->getMessage()
            ]);
        }

    }

    public function properties($id)
    {

        $data = [
            'id' => $id,
            'title' => 'Thêm thuộc tính',
            'attributes' => ProductAttribute::select('id', 'product_attributes', 'title', 'slug')->get()
        ];
        return view('Product::Product.properties')->with($data);

    }


    public function Attributes(Request $request)
    {

        $son = ($request->all());
        $product = ProductAttributeData::where('product_id', $request->id)->get();
        if ($product) {
            foreach ($product as $pro)
                ProductAttributeData::where('id', $pro->id)->delete();
        }
        foreach ($son as $key => $so) {
            if ($key != "_token" && $key != "id") {
                $slug = str_replace('_', '-', $key);
                $attribute = ProductAttribute::where('slug', $slug)->first();
                $attribute->id;
                foreach ($so as $s) {
                    $data = [
                        'product_id' => $request->id,
                        'product_attribute_id' => $attribute->id,
                        'product_attribute_item_id' => $s,
                    ];
                    $product = ProductAttributeData::create($data);
                }
            }
        }
        return redirect()->back()->with('success', 'Cập nhật sản phẩm thành công !!!');
    }
}
