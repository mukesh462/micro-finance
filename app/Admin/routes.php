<?php

use App\Admin\Controllers\CustomerController;
use App\Admin\Controllers\DocumentController;
use App\Admin\Controllers\MainController;
use App\Admin\Controllers\StaffController;
use App\Admin\Controllers\SubController;
use App\Admin\Controllers\UsersController;
use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    // $router->resource('users', UsersController::class);
    // $router->resource('pens', PenController::class);
    $router->resource('sub-centers', SubController::class);
    $router->resource('main-centers', MainController::class);
    $router->resource('employees', StaffController::class);
    $router->resource('customers', CustomerController::class);
    $router->resource('manage-documents', DocumentController::class);
    $router->resource('members', MemberController::class);

});
