<?php
/**
 * Author: XiaoFei Zhai
 * Date: 2017/12/13
 * Time: 11:47
 */

namespace App\Http\Controllers;

use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Auth\Database\Menu;
use Encore\Admin\Auth\Database\Permission;
use Encore\Admin\Auth\Database\Role;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InstallController extends Controller
{
    public function index(){
        return view('install.index');
    }
    public function creteDatabase(){
        echo "创建表goods_shares";
        flush();
        ob_flush();
        Schema::create('goods_shares', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name')->default("");
            $table->string('title')->default("");
            $table->integer('category_id')->default(0);;
            $table->string('from_site',30)->default("");
            $table->decimal('price',10,1)->default(0);
            $table->string('click_url')->default("");
            $table->text('detail')->default("");;;
            $table->string('keywords')->default("");
            $table->string('description')->default("");
            $table->string('original_id',20)->default(0);
            $table->string('cover')->default("");
            $table->text('pictures')->default("");
            $table->string('item_url')->default("");
            $table->decimal('subject',3,2)->default(0);
            $table->integer('subject_count')->default(0);
            $table->string('coupon_click_url')->default("");
            $table->date('coupon_start_time')->nullable();
            $table->date('coupon_end_time')->nullable();
            $table->decimal('coupon_amount',10,2)->default(0);
            $table->decimal('coupon_start_fee',10,2)->default(0);
            $table->integer('coupon_remain_count')->default(0);
            $table->tinyInteger('coupon_status')->default(0);
            $table->integer('view')->default(0);
            $table->integer('volume')->default(0);
            $table->integer('channel_id')->default(0);
            $table->tinyInteger('status')->default(1);

        });
        echo "  ok!<br>";
        flush();
        ob_flush();

        echo "创建表ads";
        flush();
        ob_flush();
        Schema::create('ads',function (Blueprint $table){
            $table->increments('id');
            $table->timestamps();
            $table->string('position',20)->default("");
            $table->integer('category_id')->default(0);
            $table->string('url')->default("");
            $table->string('cover')->default("");
            $table->tinyInteger('type')->default(0);
        });
        echo "  ok!<br>";
        flush();
        ob_flush();

        echo "创建表categories";
        flush();
        ob_flush();

        echo "  ok!<br>";
        flush();
        ob_flush();
        Schema::create('categories',function (Blueprint $table){
            $table->increments('id');
            $table->timestamps();
            $table->string('icon')->default("");
            $table->integer('parent_id')->default(0);
            $table->tinyInteger('order')->default(0);
            $table->tinyInteger('hidden')->default(0);
            $table->string('name')->default("");
        });


        echo "创建表channels";
        flush();
        ob_flush();
        Schema::create('channels',function (Blueprint $table){
            $table->increments('id');
            $table->timestamps();
            $table->string('name')->default("");
            $table->string('cover')->default("");
            $table->integer('parent_id')->default(0);
            $table->tinyInteger('order')->default(0);
            $table->tinyInteger('hidden')->default(0);
        });
        echo "  ok!<br>";
        flush();
        ob_flush();


        echo "创建表files";
        flush();
        ob_flush();
        Schema::create('files',function (Blueprint $table){
            $table->increments('id');
            $table->timestamps();
            $table->string('name',60)->default("");
            $table->string('path')->default("");
            $table->string('original_name')->default("");
            $table->string('md5')->default("");
            $table->integer('size')->default(0);
            $table->char('ext',10)->default("");
            $table->tinyInteger('status')->default(1);
        });
        echo "  ok!<br>";
        flush();
        ob_flush();


        echo "创建表users";
        flush();
        ob_flush();

       echo "  ok!<br>";
        flush();
        ob_flush();
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->engine              =   'InnoDB';
        });
        echo "创建表password_resets";
        flush();
        ob_flush();

       echo "  ok!<br>";
        flush();
        ob_flush();
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
            $table->engine              =   'InnoDB';
        });
        $connection = config('admin.database.connection') ?: config('database.default');

        echo "创建表admin_users";
        flush();
        ob_flush();

       echo "  ok!<br>";
        flush();
        ob_flush();
        Schema::connection($connection)->create(config('admin.database.users_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 190)->unique();
            $table->string('password', 60);
            $table->string('name');
            $table->string('avatar')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
            $table->engine              =   'InnoDB';
        });
        echo "创建表admin_rules";
        flush();
        ob_flush();

       echo "  ok!<br>";
        flush();
        ob_flush();
        Schema::connection($connection)->create(config('admin.database.roles_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->unique();
            $table->string('slug', 50);
            $table->timestamps();
            $table->engine              =   'InnoDB';
        });

        echo "创建表admin_permissions";
        flush();
        ob_flush();

       echo "  ok!<br>";
        flush();
        ob_flush();
        Schema::connection($connection)->create(config('admin.database.permissions_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->unique();
            $table->string('slug', 50);
            $table->string('http_method')->nullable();
            $table->text('http_path');
            $table->timestamps();
            $table->engine              =   'InnoDB';
        });

        echo "创建表admin_menu";
        flush();
        ob_flush();

       echo "  ok!<br>";
        flush();
        ob_flush();
        Schema::connection($connection)->create(config('admin.database.menu_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0);
            $table->integer('order')->default(0);
            $table->string('title', 50);
            $table->string('icon', 50);
            $table->string('uri', 50)->nullable();

            $table->timestamps();
            $table->engine              =   'InnoDB';
        });
        echo "创建表admin_role_users";
        flush();
        ob_flush();

       echo "  ok!<br>";
        flush();
        ob_flush();
        Schema::connection($connection)->create(config('admin.database.role_users_table'), function (Blueprint $table) {
            $table->integer('role_id');
            $table->integer('user_id');
            $table->index(['role_id', 'user_id']);
            $table->timestamps();
            $table->engine              =   'InnoDB';
        });

        echo "创建表admin_role_permissions";
        flush();
        ob_flush();

       echo "  ok!<br>";
        flush();
        ob_flush();
        Schema::connection($connection)->create(config('admin.database.role_permissions_table'), function (Blueprint $table) {
            $table->integer('role_id');
            $table->integer('permission_id');
            $table->index(['role_id', 'permission_id']);
            $table->timestamps();
            $table->engine              =   'InnoDB';
        });
        echo "创建表admin_user_permissions";
        flush();
        ob_flush();

       echo "  ok!<br>";
        flush();
        ob_flush();
        Schema::connection($connection)->create(config('admin.database.user_permissions_table'), function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('permission_id');
            $table->index(['user_id', 'permission_id']);
            $table->timestamps();
            $table->engine              =   'InnoDB';
        });

        echo "创建表role_menus";
        flush();
        ob_flush();

       echo "  ok!<br>";
        flush();
        ob_flush();
        Schema::connection($connection)->create(config('admin.database.role_menu_table'), function (Blueprint $table) {
            $table->integer('role_id');
            $table->integer('menu_id');
            $table->index(['role_id', 'menu_id']);
            $table->timestamps();
            $table->engine              =   'InnoDB';
        });

        echo "创建表admin_operation_log";
        flush();
        ob_flush();

       echo "  ok!<br>";
        flush();
        ob_flush();
        Schema::connection($connection)->create(config('admin.database.operation_log_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('path');
            $table->string('method', 10);
            $table->string('ip', 15);
            $table->text('input');
            $table->index('user_id');
            $table->timestamps();
            $table->engine              =   'InnoDB';
        });
        session(['step'=>'db_create']);
        return redirect('/install/setadmin');
    }

    public function setAdmin(){
        $step                           =   session('step');
        if($step && $step!='db_create'){
            redirect('/install');
        }
        return view('install.set_admin');
    }

    public function initDatabase(){
        $step                           =   session('step');
        if($step && $step!='db_create'){
            return redirect('/install');
        }

        $name                           =   request()->name;
        $password                       =   request()->password;
        $rePassword                     =   request()->re_password;
        if(empty($name) || empty($password)){
            return view('install.error',['message'=>'必选项不能为空']);
        }
        if($password!=$rePassword){
            return view('install.error',['message'=>'密码不一致']);
        }

        Administrator::truncate();
        Administrator::create([
            'username'  => $name,
            'password'  => bcrypt($password),
            'name'      => 'Administrator',
        ]);
        // create a role.
        Role::truncate();
        Role::create([
            'name'  => 'Administrator',
            'slug'  => 'administrator',
        ]);

        // add role to user.
        Administrator::first()->roles()->save(Role::first());

        //create a permission
        Permission::truncate();
        Permission::insert([
            [
                'name'        => 'All permission',
                'slug'        => '*',
                'http_method' => '',
                'http_path'   => '*',
            ],
            [
                'name'        => 'Dashboard',
                'slug'        => 'dashboard',
                'http_method' => 'GET',
                'http_path'   => '/',
            ],
            [
                'name'        => 'Login',
                'slug'        => 'auth.login',
                'http_method' => '',
                'http_path'   => "/auth/login\r\n/auth/logout",
            ],
            [
                'name'        => 'User setting',
                'slug'        => 'auth.setting',
                'http_method' => 'GET,PUT',
                'http_path'   => '/auth/setting',
            ],
            [
                'name'        => 'Auth management',
                'slug'        => 'auth.management',
                'http_method' => '',
                'http_path'   => "/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs",
            ],
        ]);

        Role::first()->permissions()->save(Permission::first());

        // add default menus.
        Menu::truncate();
        Menu::insert([
            [
                'parent_id' => 0,
                'order'     => 1,
                'title'     => 'Index',
                'icon'      => 'fa-bar-chart',
                'uri'       => '/',
            ],
            [
                'parent_id' => 0,
                'order'     => 2,
                'title'     => 'Admin',
                'icon'      => 'fa-tasks',
                'uri'       => '',
            ],
            [
                'parent_id' => 2,
                'order'     => 3,
                'title'     => 'Users',
                'icon'      => 'fa-users',
                'uri'       => 'auth/users',
            ],
            [
                'parent_id' => 2,
                'order'     => 4,
                'title'     => 'Roles',
                'icon'      => 'fa-user',
                'uri'       => 'auth/roles',
            ],
            [
                'parent_id' => 2,
                'order'     => 5,
                'title'     => 'Permission',
                'icon'      => 'fa-ban',
                'uri'       => 'auth/permissions',
            ],
            [
                'parent_id' => 2,
                'order'     => 6,
                'title'     => 'Menu',
                'icon'      => 'fa-bars',
                'uri'       => 'auth/menu',
            ],
            [
                'parent_id' => 2,
                'order'     => 7,
                'title'     => 'Operation log',
                'icon'      => 'fa-history',
                'uri'       => 'auth/logs',
            ],
            [
                'parent_id' => 0,
                'order'     => 8,
                'title'     => '运营管理',
                'icon'      => 'fa-history',
                'uri'       => '',
            ],
            [
                'parent_id' => 8,
                'order'     => 8,
                'title'     => '广告',
                'icon'      => 'fa-history',
                'uri'       => 'ad',
            ],
            [
                'parent_id' => 8,
                'order'     => 8,
                'title'     => '分类',
                'icon'      => 'fa-history',
                'uri'       => 'category',
            ],
            [
                'parent_id' => 8,
                'order'     => 8,
                'title'     => '商品',
                'icon'      => 'fa-history',
                'uri'       => '/goods',
            ],
            [
                'parent_id' => 8,
                'order'     => 8,
                'title'     => '商品更新',
                'icon'      => 'fa-history',
                'uri'       => 'taobao/update',
            ],
            [
                'parent_id' => 8,
                'order'     => 8,
                'title'     => '频道',
                'icon'      => 'fa-history',
                'uri'       => '/channel',
            ],
        ]);

        // add role to menu.
        Menu::find(2)->roles()->save(Role::first());
        return $this->view('install.success');
    }
}