<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['admin_auth', 'user_auth'])->group(function () {
    Route::redirect('/', 'loginPage');

    Route::view('loginPage', 'auth.login')->name('auth#login');


    Route::view('registerPage', 'auth.register')->name('auth#register');

    // Route::redirect('/logout', '', 301);

    // Route::get('/logout', function() {
    //     // return abort(404);
    //     if (Auth::user()->role == "admin") {
    //         return redirect()->route('course.list');
    //     }
    //     return redirect()->route('user.index');
    // });
});

Route::get('/logout', function () {
    // return abort(404);
    abort(404);
});


Route::middleware([
    'auth',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AuthController::class, 'dashboard'])->name('dashboard');
    // for admin

    // admin home page
    Route::group(['middleware' => 'admin_auth'], function () {
        // Route::redirect('/', 'admin/course/list')->name('home');
        Route::get('/', [App\Http\Controllers\CourseController::class, 'list'])->name('course.list');

        Route::prefix('admin')->group(function () {
            Route::prefix('category')->group(function () {
                Route::get('list', [App\Http\Controllers\CateogryController::class, 'list'])->name('category.list');
                Route::get('create', [App\Http\Controllers\CateogryController::class, 'create'])->name('category.create');
                Route::post('store', [App\Http\Controllers\CateogryController::class, 'store'])->name('category.store');
                Route::get('edit/{id}', [App\Http\Controllers\CateogryController::class, 'edit'])->name('category.edit');
                Route::post('update/{id}', [App\Http\Controllers\CateogryController::class, 'update'])->name('category.update');
                Route::post('delete/{id}', [App\Http\Controllers\CateogryController::class, 'delete'])->name('category.delete');
            });

            Route::prefix('course')->group(function () {
                Route::get('list', [App\Http\Controllers\CourseController::class, 'list'])->name('course.list');
                Route::get('create', [App\Http\Controllers\CourseController::class, 'create'])->name('course.create');
                Route::post('store', [App\Http\Controllers\CourseController::class, 'store'])->name('course.store');
                Route::get('edit/{id}', [App\Http\Controllers\CourseController::class, 'edit'])->name('course.edit');
                Route::post('update/{id}', [App\Http\Controllers\CourseController::class, 'update'])->name('course.update');
                Route::post('delete/{id}', [App\Http\Controllers\CourseController::class, 'delete'])->name('course.delete');
                Route::get('searchWithCategory', [App\Http\Controllers\CourseController::class, 'searchWithCategory'])->name('course.searchWithCategory');
            });


            // profile
            Route::get('profile', [App\Http\Controllers\ProfileController::class, 'detail'])->name('admin.profile.detail');
            Route::post('profile/update/{id}', [App\Http\Controllers\ProfileController::class, 'update'])->name('admin.profile.update');

            // change password
            Route::get('changePassword', [App\Http\Controllers\ProfileController::class, 'changePasswordPage'])->name('admin.profile.changePasswordPage');
            Route::post('changePassword', [App\Http\Controllers\ProfileController::class, 'changePassword'])->name('admin.profile.changePassword');


            Route::prefix('user-account')->group(function () {
                Route::get('list', [App\Http\Controllers\AccountController::class, 'list'])->name('admin.user_account.list');
            });

            Route::prefix('payment')->group(function () {
                Route::get('list', [App\Http\Controllers\PaymentController::class, 'list'])->name('admin.payment.list');
            });

            Route::prefix('zoomLink')->group(function () {
                Route::get('list', [App\Http\Controllers\ZoomLinkController::class, 'list'])->name('admin.zoomLink.list');
                Route::get('create/{payment_id}', [App\Http\Controllers\ZoomLinkController::class, 'create'])->name('admin.zoomLink.create');
                Route::post('store', [App\Http\Controllers\ZoomLinkController::class, 'store'])->name('admin.zoomLink.store');
                Route::get('edit/{id}', [App\Http\Controllers\ZoomLinkController::class, 'edit'])->name('admin.zoomlink.edit');
                Route::post('update/{id}', [App\Http\Controllers\ZoomLinkController::class, 'update'])->name('admin.zoomlink.update');
                Route::post('delete/{id}', [App\Http\Controllers\ZoomLinkController::class, 'delete'])->name('admin.zoomLink.delete');
            });
        });
    });

    // for user
    // Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name("user.index");
    Route::group(['middleware' => 'user_auth'], function () {
        Route::group(['prefix' => 'user'], function () {
            Route::get('/index', [App\Http\Controllers\UserController::class, 'index'])->name("user.index");
            Route::get('filter/category/{id}', [App\Http\Controllers\UserController::class, 'filterByCategory'])->name('user.filterByCategory');

            // course
            Route::get('courses', [App\Http\Controllers\UserController::class, 'user_courses'])->name('user.user_courses');
            Route::get('courses/detials/{id}', [App\Http\Controllers\UserController::class, 'user_course_detials'])->name('user.user_course_details');
            Route::get('course/{id}', [App\Http\Controllers\UserController::class, 'course_details'])->name('user.course_details');

            // payment
            Route::post('payment/create', [App\Http\Controllers\PaymentController::class, 'create'])->name('user.payment.create');
        });
    });
});
