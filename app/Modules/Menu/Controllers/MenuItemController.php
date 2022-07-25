<?php

namespace App\Modules\Menu\Controllers;

use App\Http\Controllers\Admins\AdminController;
use App\Http\Controllers\Controller;
use App\Modules\Blog\Models\Category;
use App\Modules\Post\Models\Post;
use App\Modules\Menu\Models\Menu;
use App\Modules\Menu\Models\MenuItem;
use App\Modules\Pages\Models\Page;
use App\Modules\Product\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuItemController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $menu = Menu::where('id', $id)->select('title', 'id')->first();
        $data = [
            'menu' => $menu,
            'menu_items' => MenuItem::where('menu_id', $menu->id)->orderBy('sort', 'ASC')->get(),
            'title' => 'Cấu hình ' . $menu->title,
            'post_categories' => Category::where([['is_active', 1], ['cat_type', 'post']])->select('id', 'title', 'parent_id', 'slug')->get(),
            'posts' => Post::where('is_active', 1)->select('id', 'title', 'slug')->get(),
            'pages' => Page::where('is_active', 1)->select('id', 'title', 'slug')->get(),
            'products' => Product::where('is_active', 1)->select('id', 'title', 'slug')->get(),
            'product_categories' => Category::where([['is_active', 1], ['cat_type', 'product']])->select('id', 'title', 'parent_id', 'slug')->get(),
        ];
        return view('Menu::MenuItem.index')->with($data);
    }

    /**
     * @param Request $request
     */
    public function addMenu(Request $request)
    {
        try {
            $id_menu = ($request->get('id') != "") ? $request->get('id') : '';
            $data = $request->get('data');
            if (!empty($id_menu)) {
                $data_menu = ['menu_id' => $id_menu, 'sort' => 0];
                foreach ($data as $key => $d) {
                    if ($d['type'] == "post") {
                        $post = Post::where('id', $d['id'])->select('slug', 'title')->first();
                        $data_menu = array_merge($data_menu, [
                            'title' => $post->title,
                            'slug' => '/'.$post->slug.'.ht',
                            'menu_type' => 'post',
                            'parent_id' => 0
                        ]);
                        MenuItem::create($data_menu);
                    } else if ($d['type'] == "post-category") {
                        $post_category = Category::where([['id', $d['id']], ['cat_type', 'post']])->select('slug', 'title')->first();
                        $data_menu = array_merge($data_menu, [
                            'title' => $post_category->title,
                            'slug' => '/' . $post_category->slug.'.h',
                            'menu_type' => 'post-category',
                            'parent_id' => 0
                        ]);
                        MenuItem::create($data_menu);
                    } else if ($d['type'] == "page") {
                        $page = Page::where('id', $d['id'])->select('slug', 'title')->first();
                        $data_menu = array_merge($data_menu, [
                            'title' => $page->title,
                            'slug' => 'trang/' . $page->slug,
                            'menu_type' => 'page',
                            'parent_id' => 0
                        ]);
                        MenuItem::create($data_menu);
                    } else if ($d['type'] == "product") {
                        $product = Product::where('id', $d['id'])->select('slug', 'title')->first();
                        $data_menu = array_merge($data_menu, [
                            'title' => $product->title,
                            'slug' => '/' . $product->slug.'.html',
                            'menu_type' => 'product',
                            'parent_id' => 0
                        ]);
                        MenuItem::create($data_menu);
                    } else if ($d['type'] == "product-category") {
                        $product_category = Category::where([['id', $d['id']], ['cat_type', 'product']])->select('slug', 'title')->first();
                        $data_menu = array_merge($data_menu, [
                            'title' => $product_category->title,
                            'slug' => '/' . $product_category->slug.'.htm',
                            'menu_type' => 'product-category',
                            'parent_id' => 0
                        ]);
                        MenuItem::create($data_menu);
                    } else if ($d['type'] == "link") {
                        $data_menu = array_merge($data_menu, [
                            'title' => $d['title'],
                            'slug' => ($d['link'] != "") ? $d['link'] : '',
                            'menu_type' => 'link',
                            'parent_id' => 0
                        ]);
                        MenuItem::create($data_menu);
                    }
                }
                return response()->json([
                    'success' => true,
                    'message' => 'Thêm menu ' . $data_menu['title'] . ' thành công !!!'
                ]);
            } else {
                return response()->json([
                    'status' => false, 'message' => 'Menu bạn tạo không tồn tại !!!'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteMenu($id)
    {
        try {
            DB::beginTransaction();
            MenuItem::where('id', $id)->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Xoá menu thành công !!!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }

    /**
     * @param Request $request
     */
    public function modelEditMenu(Request $request)
    {
        $id = ($request->get('id') != "") ? $request->get('id') : '';
        $menu = MenuItem::where('id', $id)->first();
        if (is_object($menu) != null) {
            $menus = MenuItem::where('menu_id', $menu->menu_id)->where('id', '<>', $menu->id)->orderBy('sort', 'ASC')->select('id', 'title', 'menu_id')->get();
            $html = "<div class='editFormModal'>";
            if ($menu->menu_type == "link") {
                $html .= '<div class="form-group"><label>Tiêu đề</label><input type="text" class="form-control" name="title" value="' . $menu->title . '" required></div>';
                $html .= '<div class="form-group"><label>Đường dẫn</label><input type="text" class="form-control" name="slug" value="' . $menu->slug . '" required></div>';
                $html .= '<input type="hidden" class="form-control" name="menu_type" value="link">';
            } elseif ($menu->menu_type == "post-category") {
                $slug = explode('/', $menu->slug);
                $categories = Category::where([['is_active', 1], ['cat_type', 'post']])->select('id', 'title', 'slug')->get();
                $html .= '<div class="form-group"><label>Tiêu đề</label><input type="text" class="form-control" name="title" value="' . $menu->title . '" required></div>';
                $html .= '<div class="form-group"><label>Danh mục</label>';
                $html .= '<select name="category_id" class="form-control select2"><option value="0">--- Trống ---</option>';
                foreach ($categories as $category) {
                    $selected = ($category->slug == $slug) ? 'selected' : '';
                    $html .= '<option value="' . $category->id . '" ' . $selected . '>' . $category->title . '</option>';
                }
                $html .= '</select>';
                $html .= '</div>';
                $html .= '<input type="hidden" class="form-control" name="menu_type" value="post-category">';
            } elseif ($menu->menu_type == "page") {
                $slug = explode('trang/', $menu->slug);
                $pages = Page::where('is_active', 1)->select('id', 'title', 'slug')->get();
                $html .= '<div class="form-group"><label>Tiêu đề</label><input type="text" class="form-control" name="title" value="' . $menu->title . '" required></div>';
                $html .= '<div class="form-group"><label>Trang</label>';
                $html .= '<select name="page_id" class="form-control select2"><option value="0">--- Trống ---</option>';
                foreach ($pages as $page) {
                    $selected = ($page->slug == $slug[1]) ? 'selected' : '';
                    $html .= '<option value="' . $page->id . '" ' . $selected . '>' . $page->title . '</option>';
                }
                $html .= '</select>';
                $html .= '</div>';
                $html .= '<input type="hidden" class="form-control" name="menu_type" value="page">';
            } elseif ($menu->menu_type == "product") {
                $slug = explode('/', $menu->slug);
                $products = Product::where('is_active', 1)->select('id', 'title', 'slug')->get();
                $html .= '<div class="form-group"><label>Tiêu đề</label><input type="text" class="form-control" name="title" value="' . $menu->title . '" required></div>';
                $html .= '<div class="form-group"><label>Sản phẩm</label>';
                $html .= '<select name="product" class="form-control select2"><option value="0">--- Trống ---</option>';
                foreach ($products as $product) {
                    $selected = ($product->slug == $slug[1]) ? 'selected' : '';
                    $html .= '<option value="' . $product->id . '" ' . $selected . '>' . $product->title . '</option>';
                }
                $html .= '</select>';
                $html .= '</div>';
                $html .= '<input type="hidden" class="form-control" name="menu_type" value="product">';
            } elseif ($menu->menu_type == "product-category") {
                $slug = explode('/', $menu->slug);
                $categories = Category::where([['is_active', 1], ['cat_type', 'product']])->select('id', 'title', 'slug')->get();
                $html .= '<div class="form-group"><label>Tiêu đề</label><input type="text" class="form-control" name="title" value="' . $menu->title . '" required></div>';
                $html .= '<div class="form-group"><label>Danh mục</label>';
                $html .= '<select name="category_id" class="form-control select2"><option value="0">--- Trống ---</option>';
                foreach ($categories as $category) {
                    $selected = ($category->slug == $slug[1]) ? 'selected' : '';
                    $html .= '<option value="' . $category->id . '" ' . $selected . '>' . $category->title . '</option>';
                }
                $html .= '</select>';
                $html .= '</div>';
                $html .= '<input type="hidden" class="form-control" name="menu_type" value="product-category">';
            }
            $html .= '<div class="form-group"><label>Menu cha</label>';
            $html .= '<select name="parent_id" class="form-control"><option value="0">--- Trống ---</option>';
            foreach ($menus as $m) {
                $selected = ($menu->parent_id == $m->id) ? 'selected' : '';
                $html .= '<option value="' . $m->id . '" ' . $selected . '>' . $m->title . '</option>';
            }
            $html .= '</select>';
            $html .= '</div>';
            $html .= '<div class="form-group"><label>Thứ tự</label><input type="number" class="form-control" name="sort" value="' . $menu->sort . '" required></div>';
            $html .= '</div>';
            $html .= "<script>jQuery(document).ready(function($){
                $('.select2').select2();
            });</script>";
            echo $html;
        } else {
            echo ' <div class="alert alert-danger">Dữ liệu không tồn tại</div>';
        }
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        try {
            $menu = MenuItem::where('id', $id)->first();
            $type = $request->get('menu_type');
            if (is_object($menu) != null) {
                $data_menu = ['menu_id' => $menu->menu_id, 'sort' => $request->get('sort')];
                if ($type == "post") {
                    $post = Post::where('id', $request->get('post_id'))->select('slug', 'title')->first();
                    $data_menu = array_merge($data_menu, [
                        'title' => ($request->get('title') != "") ? $request->get('title') : $post->title,
                        'slug' => '/'.$post->slug.'.ht',
                        'menu_type' => 'post',
                        'parent_id' => ($request->get('parent_id') != "") ? $request->get('parent_id') : 0
                    ]);
                } else if ($type == "post-category") {
                    $category = Category::where([['id', $request->get('category_id')], ['cat_type', 'post']])->select('slug', 'title')->first();
                    $data_menu = array_merge($data_menu, [
                        'title' => ($request->get('title') != "") ? $request->get('title') : $category->title,
                        'slug' => '/' . $category->slug.'.h',
                        'menu_type' => 'post-category',
                        'parent_id' => ($request->get('parent_id') != "") ? $request->get('parent_id') : 0
                    ]);
                } else if ($type == "page") {
                    $page = Page::where('id', $request->get('page_id'))->select('slug', 'title')->first();
                    $data_menu = array_merge($data_menu, [
                        'title' => ($request->get('title') != "") ? $request->get('title') : $page->title,
                        'slug' => 'trang/' . $page->slug,
                        'menu_type' => 'page',
                        'parent_id' => ($request->get('parent_id') != "") ? $request->get('parent_id') : 0
                    ]);
                } else if ($type == "product") {
                    $product = Product::where('id', $request->get('product'))->select('slug', 'title')->first();
                    $data_menu = array_merge($data_menu, [
                        'title' => ($request->get('title') != "") ? $request->get('title') : $product->title,
                        'slug' => '/' . $product->slug.'.html',
                        'menu_type' => 'product',
                        'parent_id' => ($request->get('parent_id') != "") ? $request->get('parent_id') : 0
                    ]);
                } else if ($type == "product-category") {
                    $category = Category::where([['id', $request->get('category_id')], ['cat_type', 'product']])->select('slug', 'title')->first();
                    $data_menu = array_merge($data_menu, [
                        'title' => ($request->get('title') != "") ? $request->get('title') : $category->title,
                        'slug' => '/' . $category->slug.'.htm',
                        'menu_type' => 'product-category',
                        'parent_id' => ($request->get('parent_id') != "") ? $request->get('parent_id') : 0
                    ]);
                } else if ($type == "link") {
                    $data_menu = array_merge($data_menu, [
                        'title' => $request->get('title'),
                        'slug' => $request->get('slug'),
                        'menu_type' => 'link',
                        'parent_id' => ($request->get('parent_id') != "") ? $request->get('parent_id') : 0
                    ]);
                }
                MenuItem::where('id', $id)->update($data_menu);
                return redirect()->back()->with('success', 'Cập nhật menu thành công !!!');
            } else {
                return redirect()->back()->with('error', 'Lỗi: Menu không tồn tại');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteAll(Request $request)
    {
        try {
            $id = $request->get('id');
            DB::beginTransaction();
            MenuItem::whereIn('id', $id)->delete();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Xoá menu thành công !!!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveSortMenu(Request $request)
    {
        $id = ($request->get('id') != "") ? $request->get('id') : '';
        $data = ($request->get('data') != "") ? json_decode($request->get('data'), true) : '';
        $readbleArray = $this->parseJsonArray($data);
        try {
            foreach ($readbleArray as $key => $value) {
                if (is_array($value)) {
                    $data_insert = array(
                        'sort' => $key,
                        'parent_id' => $value['parentID']
                    );
                    $menuChildren = MenuItem::where('id', $value['id'])->select('id')->first();
                    if (is_object($menuChildren) != null) {
                        MenuItem::where([['id', $value['id']], ['menu_id', $id]])->update($data_insert);
                    }
                }
            }
            return response()->json([
                'success' => true,
                'message' => 'Cập nhật vị trí menu thành công !!!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi: ' . $e->getMessage() . ' line ' . $e->getLine()
            ]);
        }
    }

    /**
     * @param $jsonArray
     * @param int $parentID
     * @return array
     */
    public function parseJsonArray($jsonArray, $parentID = 0)
    {
        $return = array();
        foreach ($jsonArray as $subArray) {
            $returnSubSubArray = array();
            if (isset($subArray['children'])) {
                $returnSubSubArray = $this->parseJsonArray($subArray['children'], $subArray['id']);
            }
            $return[] = array('id' => $subArray['id'], 'parentID' => $parentID);
            $return = array_merge($return, $returnSubSubArray);
        }
        return $return;
    }
}
