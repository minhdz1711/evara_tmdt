<?php

namespace App\Modules\Product\Controllers;

use App\Http\Controllers\Admins\AdminController;
use App\Http\Controllers\Controller;
use App\Modules\Product\Models\AttributeItem;

use App\Modules\User\Models\Actionhistoryuser;
use App\Modules\Product\Models\ProductAttribute;
use App\Modules\Category\Models\Category;
use App\Modules\Product\Requests\Attributes\StorevalueRequest;
use App\Modules\Product\Requests\Attributes\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AttributesItemController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $data = [
            'product_attribute_item' => AttributeItem::where('product_attribute_id', $id)->get(),
            'productss' => Category::where([['is_active', 1], ['cat_type', 'product']])->select('title', 'id')->get(),
            'category' => ProductAttribute::where('id', $id)->first(),
            'title' => 'Thêm giá trị thuộc tính',
            'categor2y' => Category::where([['is_active', 1]])->select('id', 'title', 'parent_id')->get()
        ];

        return view('Product::Attributes.listvalue')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorevalueRequest $request)
    {
        $input = $request->all();

        $attribute_value_id = AttributeItem::select('id')->where('product_attribute_id', $request->get('id'))->get()->toArray();

        if ($attribute_value_id) {
            try {
                DB::beginTransaction();
                $attribute_value_id = array_column($attribute_value_id, 'id');

                // Get submitted id data update
                $submitted_attribute_value_id = $input['attribute_value_id'];

                // Get removed attribute value id
                $removed_attribute_value_id = array_diff($attribute_value_id, $submitted_attribute_value_id);
                AttributeItem::whereIn('id', $removed_attribute_value_id)->delete();
                $value_names = $input['attribute_value_name'];
                foreach ($submitted_attribute_value_id as $attr_value_id) {

                    $attribute_value = AttributeItem::find($attr_value_id);
                    $value_name = $value_names[$attr_value_id];
                    $attribute_value->title = $value_name;
                    $attribute_value->save();
                }
                foreach ($value_names as $key => $value_name) {
                    if (!in_array($key, $submitted_attribute_value_id)) {
                        $attribute_id = $request->get('id');
                        $attribute_value = [
                            'title' => $value_name,
                            'slug' => Str::slug($value_name . $attribute_id),
                            'product_attribute_id' => $attribute_id,
                        ];
                        $attribute_value = AttributeItem::create($attribute_value);
                    }

                }
                DB::commit();
                return redirect()->back()->with('success', 'Thêm thuộc tính thành công !!!');
            } catch (\Exception $e) {
                dd($e->getMessage());
                return redirect()->back()->with('error', 'Lỗi: ' . $e->getMessage());
            }
        }


        $value_names = $input['attribute_value_name'];
        foreach ($value_names as $key => $value_name) {
            $attribute_id = $request->get('id');
            $attribute_value = [
                'title' => $value_name,
                'slug' => Str::slug($value_name . $attribute_id),
                'product_attribute_id' => $attribute_id,
            ];
            $attribute_value = AttributeItem::create($attribute_value);
            return redirect()->back()->with('success', 'Thêm danh mục thành công !!!');
        }
        return redirect()->back()->with('success', 'Thêm danh mục thành công !!!');


    }


    public function deleteAll(Request $request)
    {

        try {
            $id = $request->get('id');
            DB::beginTransaction();
            AttributeItem::where('id', $id)->delete();

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
