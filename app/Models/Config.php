<?php

namespace App\Models;

use App\Modules\Category\Models\Category;
use App\Modules\Menu\Models\Menu;
use App\Modules\Menu\Models\MenuItem;
use App\Modules\Menu\Models\MenuPosition;
use App\Modules\Product\Models\AttributeItem;
use App\Modules\Product\Models\Brands;
use App\Modules\Product\Models\Product;
use App\Modules\Product\Models\ProductAttributeData;
use App\Modules\Post\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class Config extends Model
{
    /**
     * @param $parent_id
     * @return string
     */
    public static function showCategoryParent($parent_id, $table)
    {
        if ($parent_id != 0) {
            $category = DB::table($table)->where('id', $parent_id)->select('title')->first();
            if (is_object($category) != null) {
                return '<span class="badge badge-success">' . $category->title . '</span>';
            } else {
                return '<span class="badge badge-primary">Trống</span>';
            }
        } else {
            return '<span class="badge badge-primary">Trống</span>';
        }
    }

    public static function showCategoryParents($parent_id, $table)
    {


        if ($parent_id != 0) {

            $category = DB::table($table)->where('id', $parent_id)->select('title')->first();

            if (is_object($category) != null) {
                return '<span class="badge badge-success">' . $category->title . '</span>';
            } else {
                return '<span class="badge badge-primary">Trống</span>';
            }
        } else {
            return '<span class="badge badge-primary">Trống</span>';
        }
    }


    /**
     * @param $categories
     * @param int $parent_id
     * @param string $char
     */
    public static function showCategories($categories, $parent_id = 0, $char = '', $selected_id = 0)
    {
        foreach ($categories as $key => $item) {
            if ($item->parent_id == $parent_id) {
                $selected = ($item->id == $selected_id) ? 'selected' : '';
                echo "<option value='" . $item->id . "'" . $selected . ">" . $char . $item->title . '</option>';
                unset($categories[$key]);
                self::showCategories($categories, $item->id, $char . '—', $selected_id);
            }
        }
    }

    /**
     * @param $categories
     * @param int $parent_id
     * @param string $char
     * @param array $selected_id
     * @param $name_value
     */
    public static function showCheckCategories($categories, $parent_id = 0, $char = '', $selected_id = [], $name_value)
    {
        foreach ($categories as $key => $item) {
            if ($item->parent_id == $parent_id) {
                $checked = (in_array($item->id, $selected_id)) ? 'checked' : '';
                echo "<li id='popular-category-" . $item->id . "' class='popular-category'><div class='custom-control custom-checkbox'>" . $char . "<input type='checkbox' class='custom-control-input' id='customCheck" . $name_value . "-" . $item->id . "' name='" . $name_value . "' value='" . $item->id . "'" . $checked . "><label class='custom-control-label' for='customCheck" . $name_value . "-" . $item->id . "'> " . $item->title . '</label></div></li>';
                unset($categories[$key]);
                self::showCheckCategories($categories, $item->id, $char . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $selected_id, $name_value);
            }
        }
    }


    /**
     * @param $tags
     * @param int $is_active
     * @param string $char
     * @param array $selected_id
     * @param $name_value
     */
    public static function showCheckTags($tags, $is_active = 1, $char = '', $selected_id = [], $name_value)
    {
        foreach ($tags as $key => $item) {
            if ($item->is_active==$is_active) {
                $checked = (in_array($item->id, $selected_id)) ? 'checked' : '';
                echo "<li id='popular-category-" . $item->id . "' class='popular-category'><div class='custom-control custom-checkbox'>" . $char . "<input type='checkbox' class='custom-control-input' id='customCheck" . $name_value . "-" . $item->id . "' name='" . $name_value . "' value='" . $item->id . "'" . $checked . "><label class='custom-control-label' for='customCheck" . $name_value . "-" . $item->id . "'> " . $item->title . '</label></div></li>';
                unset($tags[$key]);
                self::showCheckCategories($tags, $item->id, $char . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $selected_id, $name_value);
            }
        }
    }

    /**
     * @param $categories
     * @param int $parent_id
     * @param string $char
     * @param array $selected_id
     * @param $name_value
     */
    public static function showRadioCategories($categories, $char = '', $selected_id = [], $name_value)
    {
        foreach ($categories as $key => $item) {
            $checked = (in_array($item->id, $selected_id)) ? 'checked' : '';
            echo "<li id='radio-category-" . $item->id . "' class='popular-category'><div class='custom-control custom-radio'>" . $char . "<input type='radio' class='custom-control-input' id='customRadio" . $name_value . "-" . $item->id . "' name='" . $name_value . "' value='" . $item->id . "'" . $checked . "><label class='custom-control-label' for='customRadio" . $name_value . "-" . $item->id . "'> " . $item->title . '</label></div></li>';
        }
    }

    /**
     * @param $id
     * @return string
     */
    public static function showAuthor($id)
    {
        $user = User::where('id', $id)->select('display_name', 'username')->first();
        $name = ($user->display_name != "") ? $user->display_name : $user->username;
        return '<span class="badge badge-primary">' . $name . '</span>';
    }

    /**
     * @param $value
     * @return string
     *
     */
    public static function showCategoryPost($value)
    {
        $id = [];
        $category = DB::table('category_post')->where('post_id', $value)->get();
        foreach ($category as $cate) {
            $id[] = $cate->category_id;
        }
        $categories = Category::whereIn('id', $id)->select('title', 'id')->get();
        $html = "";
        $html .= "<div class='category-list-table'>";
        if (count($categories) > 0) {
            foreach ($categories as $category) {
                $html .= '<span class="title-cate text-primary">' . $category->title . '</span><span class="dot">, </span>';
            }
        } else {
            $html .= '<span class="title-cate text-primary">Trống</span>';
        }
        $html .= "</div>";
        return $html;
    }




    /**
     * @param $value
     * @return string
     */
    public static function showCategoryProduct($value)
    {
        $id = [];
        $category = DB::table('category_product')->where('product_id', $value)->get();
        foreach ($category as $cate) {
            $id[] = $cate->category_id;
        }
        $categories = Category::whereIn('id', $id)->select('title', 'id')->get();
        $html = "";
        $html .= "<div class='category-list-table'>";
        if (count($categories) > 0) {
            foreach ($categories as $category) {
                $html .= '<span class="title-cate text-primary">' . $category->title . '</span><span class="dot">, </span>';
            }
        } else {
            $html .= '<span class="title-cate text-primary">Trống</span>';
        }
        $html .= "</div>";
        return $html;
    }

    /**
     * @param $value
     * @return string
     */
    public static function showCategoryVideo($value)
    {
        $id = [];
        $category = DB::table('category_video')->where('video_id', $value)->get();
        foreach ($category as $cate) {
            $id[] = $cate->category_id;
        }
        $categories = Category::whereIn('id', $id)->select('title', 'id')->get();
        $html = "";
        $html .= "<div class='category-list-table'>";
        if (count($categories) > 0) {
            foreach ($categories as $category) {
                $html .= '<span class="title-cate text-primary">' . $category->title . '</span><span class="dot">, </span>';
            }
        } else {
            $html .= '<span class="title-cate text-primary">Trống</span>';
        }
        $html .= "</div>";
        return $html;
    }


    /**
     * @param $value
     * @return string
     */

    public static function ProductBrands($value)
    {

        $categories = Brands::where('id', $value)->select('title', 'id')->first();
        $html = " ";
        if ($categories) {

            $html .= '<span class="title-cate text-primary">' . $categories->title . '</span><span class="dot"> </span>';

        } else {
            $html .= '<span class="title-cate text-primary">Trống</span>';
        }
        $html .= "</div>";
        return $html;
    }

    /**
     * @param $value
     */
    public static function showRoles($value)
    {
        $role = Role::where('id', $value)->select('display_name')->first();
        return '<span class="badge badge-success">' . $role->display_name . '</span>';
    }


    /**
     * @param $id
     * @return string
     */
    public static function showUserInfo($id)
    {
        $user = User::where('id', $id)->select('username', 'email', 'display_name')->first();
        $html = "Tên: " . $user->display_name . '<br>';
        $html .= 'Tên đăng nhập: ' . $user->username . '</br>';
        $html .= 'Email: ' . $user->email;
        return $html;
    }

    /**
     * @param $regular_price
     * @param $sale_price
     */
    public static function getPriceProduct($regular_price, $sale_price)
    {
        if ($regular_price != 0 || $sale_price != 0) {
            if ($sale_price != 0) {
                return '<span class="badge badge-success">' . number_format($sale_price, 0, '', '.') . ' VNĐ</span> <br> <span class="badge badge-danger"><del>' . number_format($regular_price, 0, '', '.') . ' VNĐ</del></span>';;
            } else {
                return '<span class="badge badge-success">' . number_format($regular_price, 0, '', '.') . ' VNĐ</span>';
            }
        } else {
            return '<span class="badge badge-success">Miễn phí</span>';
        }
    }

    /**
     * getPositionMenu
     * @param $value
     * @return string
     */
    public function getPositionMenu($value)
    {
        $position = MenuPosition::where('id', $value)->select('title')->first();
        return "<div class='badge badge-success'>" . $position->title . "</div>";
    }

    /**
     * @param $menus
     * @param int $parent_id
     * @param string $char
     */
    public function getMenu($menus, $parent_id = 0, $char = '')
    {
        $cate_child = array();
        foreach ($menus as $key => $item) {
            if ($item->parent_id == $parent_id) {
                $cate_child[] = $item;
                unset($menus[$key]);
            }
        }

        if ($cate_child) {
            echo '<ol class="dd-list" style=";display: block">';
            foreach ($cate_child as $key => $item) {
                echo '<li  class="dd-item" style="list-style: none" data-id="' . $item->id . '">
                        <div class="dd-handle">
                            <div class="custom-control custom-checkbox" style="float: left;">
                                <input type="checkbox" class="custom-control-input check-permision" id="customCheckbox' . $item->title . '-' . $item->id . '" name="menu_id" value="' . $item->id . '">
                                <label class="custom-control-label" for="customCheckbox' . $item->title . '-' . $item->id . '"></label>
                            </div>' . $item->title . '
                            <div class="menu-action"><span>' . $item->slug . '</span>
                                <a href="#" class="editClick float-right dd-nodrag" name="' . $item->title . '" data-toggle="modal" data-target="#editModal" data-id="' . $item->id . '" link="' . route('admin.menu-item.update', $item->id) . '">
                                <i class="ace-icon fa fa-pencil bigger-130"></i></a>
                                <a href="#" name="' . $item->title . '" link="' . route('admin.menu-item.delete', $item->id) . '" title="Xoá"
                                class="deleteClick float-right dd-nodrag" data-toggle = "modal" data-target = "#deleteModal"><i class="ace-icon fa fa-trash-o bigger-130" ></i></a>
                            </div>
                        </div>';
                self::getMenu($menus, $item->id, '20px');
                echo '</li>';
            }
            echo "</ol>";
        }
    }

    /**
     * @param $position
     */
    public static function showMenu($position, $contaiener)
    {
        $menuPosition = MenuPosition::where('slug', $position)->select('id')->first();
        $menu = Menu::where([['id_position', $menuPosition->id], ['is_active', 1]])->select('id')->first();
        if (is_object($menu) != null) {
            $menus = MenuItem::where('menu_id', $menu->id)->orderBy('sort', 'ASC')->get();
            self::getMenuHome($menus, $parent_id = 0, $contaiener);
        }
    }

    /**
     * @param $menus
     * @param int $parent_id
     * @param $contaiener
     */
    public function getMenuHome($menus, $parent_id = 0, $contaiener)
    {
        $cate_child = array();
        foreach ($menus as $key => $item) {
            if ($item->parent_id == $parent_id) {
                $cate_child[] = $item;
                unset($menus[$key]);
            }
        }

        if ($cate_child) {
            echo '<ul class="' . $contaiener . '">';
            foreach ($cate_child as $key => $item) {
//                if($item->parent_id===0 && ($item->id===$item->parent_id)){
//                    echo '<li id="menu-item-' . $item->id . '" class="nav-item has-dropdown" style="list-style: none"><a href="' . $item->slug . '">' . $item->title . '<i class="fa fa-angle-down"></i></a>';
//                }
//                else{
//                    echo '<li id="menu-item-' . $item->id . '" class="nav-item" style="list-style: none"><a href="' . $item->slug . '">' . $item->title . '</a>';
//                }
                echo '<li id="menu-item-' . $item->id . '" class="nav-item" style="list-style: none"><a href="' . $item->slug . '">' . $item->title . '</a>';
                self::getMenuHome($menus, $item->id, 'sub-menu');
                echo '</li>';
            }
            echo "</ul>";
        }
    }

    /**
     * @param $menus
     * @param int $parent_id
     * @param $contaiener
     */
    public static function getMenuByName($position, $contaiener)
    {
        $menuPosition = MenuPosition::where('slug', $position)->select('id')->first();
        dd($menuPosition->id);
        $menu = Menu::where([['id_position', $menuPosition->id], ['is_active',1]])->select('id', 'title')->first();
        if (is_object($menu) != null) {
            $menus = MenuItem::where('menu_id', $menu->id)->orderBy('sort', 'ASC')->get();
            echo '<div class="footer-top"><div class="footer-title"><h3>' . $menu->title . '</h3></div></div>';
            echo '<div class="footer-menu">';
            self::getMenuHome($menus, $parent_id = 0, $contaiener);
            echo '</div>';
        }
    }

    public static function getAttributeByID($id)
    {
        $data = AttributeItem::where('product_attribute_id', $id)->select('id', 'title')->get();
        return $data;
    }

    public static function getAttributeSelected($id_product, $id_attribute)
    {
        $data = ProductAttributeData::where([['product_id', $id_product], ['product_attribute_id', $id_attribute]])->select('product_attribute_item_id')->get();
        $args = [];
        foreach ($data as $d) {
            $args[] = $d->product_attribute_item_id;
        }
        return $args;
    }

    public static function getProductComment($id){
        $name=Product::where([['id',$id],['is_active',1]])->first();
        return '<p>' .$name->title. '</p>';
    }
}
