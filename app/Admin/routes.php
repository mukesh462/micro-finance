<?php

use App\Admin\Controllers\CenterController;
use App\Admin\Controllers\CustomerController;
use App\Admin\Controllers\DayBookController;
use App\Admin\Controllers\DocumentController;
use App\Admin\Controllers\IndexController;
use App\Admin\Controllers\MainController;
use App\Admin\Controllers\MemberController;
use App\Admin\Controllers\PenController;
use App\Admin\Controllers\ProductController;
use App\Admin\Controllers\ReasonController;
use App\Admin\Controllers\StaffController;
use App\Admin\Controllers\SubController;
use App\Admin\Controllers\UsersController;
use App\Admin\Controllers\VoucherController;

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
    $router->resource('pens', PenController::class);
    $router->resource('centers', CenterController::class);
    $router->resource('main-centers', MainController::class);
    $router->resource('employees', StaffController::class);
    $router->resource('customers', CustomerController::class);
    $router->resource('manage-documents', DocumentController::class);
    $router->resource('members', MemberController::class);
    $router->resource('products', ProductController::class);
    $router->resource('indexes', IndexController::class);
    $router->get('indexes/create', "CustomerController@create_index");
    $router->resource('vouchers', VoucherController::class);
    $router->resource('dayBookReport', DayBookController::class);
    $router->get('viewDayBookReport/{id}', "DayBookController@viewDayBookReport");
    $router->get('getEmployees', "StaffController@getEmployees");
    $router->get('getReason', "ReasonController@getReason");
    $router->resource('reasons', ReasonController::class);
    $router->get('singleCollection', "DayBookController@singleCollection");
    $router->get('getCenter', "CenterController@getCenter");
    $router->post('getDetails', "CenterController@getDetails");
    // $router->get('pens/create', [IndexController::class, 'Disbursement']);
    $router->get('loan', [IndexController::class, 'Disbursement']);

    $router->get('pens/{id}/edits', [IndexController::class, 'editt']);
    $router->post('addIndex', [IndexController::class, 'addIndex'])->name('add.index');
    $router->get('indexes/{id}/edits', [IndexController::class, 'EditViewIndex']);
    $router->post('editIndex', [IndexController::class, 'editIndex'])->name('edit.index');
    $router->get('indexes/{id}/view', [IndexController::class, 'ViewIndex']);
    $router->post('loan_disbrusment', [IndexController::class, 'loan_disbrusment']);

    $router->get('member/create', [MemberController::class, 'Memberform']);
});
