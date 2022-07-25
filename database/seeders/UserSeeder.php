<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'admin', 'display_name' => 'Quản trị viên', 'guard_name' => 'admin']);
        Role::create(['name' => 'seo', 'display_name' => 'Seo Editor', 'guard_name' => 'admin']);
        Role::create(['name' => 'author', 'display_name' => 'Tác giả', 'guard_name' => 'admin']);
        Role::create(['name' => 'user', 'display_name' => 'Người dùng đăng ký', 'guard_name' => 'admin']);

        //post
        Permission::create(['name' => 'post-list', 'group' => 'roles', 'display_name' => 'Xem bài viết', 'guard_name' => 'admin', 'group_name' => 'Quản lý bài viết']);
        Permission::create(['name' => 'post-create', 'group' => 'roles', 'display_name' => 'Thêm bài viết', 'guard_name' => 'admin', 'group_name' => 'Quản lý bài viết']);
        Permission::create(['name' => 'post-update', 'group' => 'roles', 'display_name' => 'Sửa bài viết', 'guard_name' => 'admin', 'group_name' => 'Quản lý bài viết']);
        Permission::create(['name' => 'post-delete', 'group' => 'roles', 'display_name' => 'Xóa bài viết', 'guard_name' => 'admin', 'group_name' => 'Quản lý bài viết']);

        //post category
        Permission::create(['name' => 'post-category-list', 'group' => 'roles', 'display_name' => 'Xem danh mục bài viết', 'guard_name' => 'admin', 'group_name' => 'Danh mục bài viết']);
        Permission::create(['name' => 'post-category-create', 'group' => 'roles', 'display_name' => 'Thêm danh mục bài viết', 'guard_name' => 'admin', 'group_name' => 'Danh mục bài viết']);
        Permission::create(['name' => 'post-category-update', 'group' => 'roles', 'display_name' => 'Sửa danh mục bài viết', 'guard_name' => 'admin', 'group_name' => 'Danh mục bài viết']);
        Permission::create(['name' => 'post-category-delete', 'group' => 'roles', 'display_name' => 'Xóa danh mục bài viết', 'guard_name' => 'admin', 'group_name' => 'Danh mục bài viết']);

        //page
        Permission::create(['name' => 'page-list', 'group' => 'roles', 'display_name' => 'Xem trang tĩnh', 'guard_name' => 'admin', 'group_name' => 'Quản lý trang tĩnh']);
        Permission::create(['name' => 'page-create', 'group' => 'roles', 'display_name' => 'Thêm trang tĩnh', 'guard_name' => 'admin', 'group_name' => 'Quản lý trang tĩnh']);
        Permission::create(['name' => 'page-update', 'group' => 'roles', 'display_name' => 'Sửa trang tĩnh', 'guard_name' => 'admin', 'group_name' => 'Quản lý trang tĩnh']);
        Permission::create(['name' => 'page-delete', 'group' => 'roles', 'display_name' => 'Xóa trang tĩnh', 'guard_name' => 'admin', 'group_name' => 'Quản lý trang tĩnh']);

        //gallery
        Permission::create(['name' => 'media-list', 'group' => 'roles', 'display_name' => 'Xem thư viện', 'guard_name' => 'admin', 'group_name' => 'Quản lý thư viện']);

        //order
        Permission::create(['name' => 'product-order-list', 'group' => 'roles', 'display_name' => 'Xem đơn hàng', 'guard_name' => 'admin', 'group_name' => 'Quản lý đơn hàng']);
        Permission::create(['name' => 'product-order-update', 'group' => 'roles', 'display_name' => 'Cập nhật đơn hàng', 'guard_name' => 'admin', 'group_name' => 'Quản lý đơn hàng']);
        Permission::create(['name' => 'product-order-delete', 'group' => 'roles', 'display_name' => 'Xóa đơn hàng', 'guard_name' => 'admin', 'group_name' => 'Quản lý đơn hàng']);


        //theme
        Permission::create(['name' => 'theme-list', 'group' => 'roles', 'display_name' => 'Quản lý giao diện', 'guard_name' => 'admin', 'group_name' => 'Quản lý giao diện']);
        Permission::create(['name' => 'theme-menu', 'group' => 'roles', 'display_name' => 'Quản lý menu', 'guard_name' => 'admin', 'group_name' => 'Quản lý giao diện']);
        Permission::create(['name' => 'theme-slide', 'group' => 'roles', 'display_name' => 'Quản lý trình diễn ảnh', 'guard_name' => 'admin', 'group_name' => 'Quản lý giao diện']);
        Permission::create(['name' => 'theme-banner', 'group' => 'roles', 'display_name' => 'Quản lý banner', 'guard_name' => 'admin', 'group_name' => 'Quản lý giao diện']);

        //comment
        Permission::create(['name' => 'comment-list', 'group' => 'roles', 'display_name' => 'Xem bình luận', 'guard_name' => 'admin', 'group_name' => 'Quản lý bình luận']);
        Permission::create(['name' => 'comment-update', 'group' => 'roles', 'display_name' => 'Sửa bình luận', 'guard_name' => 'admin', 'group_name' => 'Quản lý bình luận']);
        Permission::create(['name' => 'comment-delete', 'group' => 'roles', 'display_name' => 'Xoá bình luận', 'guard_name' => 'admin', 'group_name' => 'Quản lý bình luận']);

//        //payment
//        Permission::create(['name' => 'payment-list', 'group' => 'roles', 'display_name' => 'Xem ví điện tử', 'guard_name' => 'admin', 'group_name' => 'Quản lý ví điện tử']);
//        Permission::create(['name' => 'payment-update', 'group' => 'roles', 'display_name' => 'Sửa ví điện tử', 'guard_name' => 'admin', 'group_name' => 'Quản lý ví điện tử']);
//        Permission::create(['name' => 'payment-delete', 'group' => 'roles', 'display_name' => 'Xóa ví điện tử', 'guard_name' => 'admin', 'group_name' => 'Quản lý ví điện tử']);

//        //partner
//        Permission::create(['name' => 'partner-list', 'group' => 'roles', 'display_name' => 'Xem đối tác kết nối', 'guard_name' => 'admin', 'group_name' => 'Quản lý đối tác']);
//        Permission::create(['name' => 'partner-create', 'group' => 'roles', 'display_name' => 'Thêm đối tác mới', 'guard_name' => 'admin', 'group_name' => 'Quản lý đối tác']);
//        Permission::create(['name' => 'partner-update', 'group' => 'roles', 'display_name' => 'Sửa đối tác', 'guard_name' => 'admin', 'group_name' => 'Quản lý đối tác']);
//        Permission::create(['name' => 'partner-history', 'group' => 'roles', 'display_name' => 'Xoá đối tác', 'guard_name' => 'admin', 'group_name' => 'Quản lý đối tác']);

        //user
        Permission::create(['name' => 'user-list', 'group' => 'roles', 'display_name' => 'Xem tài khoản', 'guard_name' => 'admin', 'group_name' => 'Quản lý tài khoản']);
        Permission::create(['name' => 'user-create', 'group' => 'roles', 'display_name' => 'Thêm tài khoản mới', 'guard_name' => 'admin', 'group_name' => 'Quản lý tài khoản']);
        Permission::create(['name' => 'user-update', 'group' => 'roles', 'display_name' => 'Sửa tài khoản', 'guard_name' => 'admin', 'group_name' => 'Quản lý tài khoản']);
        Permission::create(['name' => 'user-history', 'group' => 'roles', 'display_name' => 'Xoá tài khoản', 'guard_name' => 'admin', 'group_name' => 'Quản lý tài khoản']);

        //roles
        Permission::create(['name' => 'role-list', 'group' => 'roles', 'display_name' => 'Xem phần quyền', 'guard_name' => 'admin', 'group_name' => 'Phân quyền']);
        Permission::create(['name' => 'role-create', 'group' => 'roles', 'display_name' => 'Thêm phần quyền', 'guard_name' => 'admin', 'group_name' => 'Phân quyền tài khoản']);
        Permission::create(['name' => 'role-update', 'group' => 'roles', 'display_name' => 'Sửa phần quyền', 'guard_name' => 'admin', 'group_name' => 'Phân quyền tài khoản']);
        Permission::create(['name' => 'role-delete', 'group' => 'roles', 'display_name' => 'Xóa phần quyền', 'guard_name' => 'admin', 'group_name' => 'Phân quyền tài khoản']);

        //user history
        Permission::create(['name' => 'history-list', 'group' => 'roles', 'display_name' => 'Xem lịch sử đăng nhập', 'guard_name' => 'admin', 'group_name' => 'Lịch sử tài khoản']);
        Permission::create(['name' => 'history-delete', 'group' => 'roles', 'display_name' => 'Xóa lịch sử đăng nhập', 'guard_name' => 'admin', 'group_name' => 'Lịch sử tài khoản']);

        //setting
        Permission::create(['name' => 'setting-list', 'group' => 'roles', 'display_name' => 'Cài đặt hệ thống', 'guard_name' => 'admin', 'group_name' => 'Cài đặt']);

        //create user
        $user = User::create([
            'display_name' => 'Minh DZ',
            'username' => 'Minhdz1711',
            'email' => 'admin@mmz.vn',
            'password' => bcrypt('12345678'),
            'position' => 1,
            'is_active' => 1
        ]);

        $permissions = Permission::pluck('id', 'id')->all();
        $admin->syncPermissions($permissions);
        $user->assignRole([$admin->id]);
    }
}
