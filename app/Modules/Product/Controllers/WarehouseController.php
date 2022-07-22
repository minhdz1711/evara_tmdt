<?php

namespace App\Modules\Product\Controllers;

use App\Http\Controllers\Admins\AdminController;
use App\Modules\Product\Models\Product;
use App\Modules\Product\Requests\StoreRequest;
use App\Modules\Product\Requests\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WarehouseController extends AdminController
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
                        'products' => Product::select('id', 'images', 'title', 'id_user', 'is_active', 'is_hot', 'regular_price', 'sale_price', 'created_at', 'guarantee', 'quantity', 'vat', 'value_vat')->orderBy('id', 'DESC')->paginate(10)
                    ]);
                    break;
                case "title":
                    $data = array_merge($data, [
                        'products' => Product::where('title', 'like', '%' . $request->keyword . '%')->orderBy('id', 'DESC')->select('id', 'images', 'title', 'id_user', 'is_active', 'is_hot', 'regular_price', 'sale_price', 'created_at')->paginate(10),
                    ]);
                    break;
                case "status":
                    if ($request->keyword == "Inactive") {
                        $data = array_merge($data, [
                            'products' => Product::where('is_active', 0)->orderBy('id', 'DESC')->select('id', 'images', 'title', 'id_user', 'is_active', 'is_hot', 'regular_price', 'sale_price', 'created_at')->paginate(10),
                        ]);
                    } elseif ($request->keyword == "Active") {
                        $data = array_merge($data, [
                            'products' => Product::where('is_active', 1)->orderBy('id', 'DESC')->select('id', 'images', 'title', 'id_user', 'is_active', 'is_hot', 'regular_price', 'sale_price', 'created_at', 'guarantee', 'quantity', 'vat', 'value_vat')->paginate(10),
                        ]);
                    } else {
                        if ($request->get('keyword') != 0) {
                            $data = array_merge($data, [
                                'products' => Product::where('title', 'like', '%' . $request->keyword . '%')->orderBy('id', 'DESC')->select('id', 'images', 'title', 'id_user', 'is_active', 'is_hot', 'regular_price', 'sale_price', 'created_at', 'guarantee', 'quantity', 'vat', 'value_vat')->paginate(15),
                            ]);
                        } else {
                            $data = array_merge($data, [
                                'products' => Product::orderBy('id', 'DESC')->select('id', 'images', 'title', 'id_user', 'is_active', 'is_hot', 'regular_price', 'sale_price', 'created_at')->paginate(10),
                            ]);
                        }
                    }
                    break;
                case "featured":
                    $data = array_merge($data, [
                        'products' => Product::where('is_hot', 1)->where('title', 'like', '%' . $request->keyword . '%')->orderBy('id', 'DESC')->select('id', 'images', 'title', 'id_user', 'is_active', 'is_hot', 'regular_price', 'sale_price', 'created_at')->paginate(10),
                    ]);
                    break;
                case "author":
                    $data = array_merge($data, [
                        'products' => Product::join('users', 'users.id', '=', 'products.id_user')
                            ->where('users.display_name', 'like', '%' . $request->keyword . '%')
                            ->orderBy('id', 'DESC')
                            ->select('products.id', 'products.images', 'products.title', 'products.id_user', 'products.is_active', 'products.is_hot', 'products.regular_price', 'products.sale_price', 'products.created_at')
                            ->paginate(10),
                    ]);
                    break;
            }
        } else {
            $data = array_merge($data, [
                'products' => Product::select('id', 'images', 'title', 'id_user', 'is_active', 'is_hot', 'regular_price', 'sale_price', 'created_at', 'guarantee', 'quantity', 'vat', 'value_vat')->orderBy('id', 'DESC')->paginate(10)
            ]);

        }

        return view('Product::Warehouse.list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)


    {

        try {
            DB::beginTransaction();

            $sale_prices = 0;
            $regular_price = str_replace([',', '.', ''], '', $request->get('regular_price'));
            $sale_price = ($request->get('sale_price') != "") ? str_replace([',', '.', ''], '', $request->get('sale_price')) : ($sale_prices);
            if ($sale_price > $regular_price) {
                $sale_price = 0;
            }
            $product = Product::whereId($id)->first();
            $product->regular_price = $regular_price;
            $product->sale_price = $sale_price;
            $product->quantity = $request->quantity;
            $product->guarantee = $request->guarantee;
            $product->vat = $request->vat;
            $product->value_vat = $request->value_vat;
            $product->update();
            DB::commit();
            return redirect()->route('admin.warehouse.index')->with('success', 'Cập nhật sản phẩm thành công !!!');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

}
