<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;


// auth controller
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

//dashboard controller
use App\Http\Controllers\DashboardController;

// users controllers
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\RoleController;
use App\Http\Controllers\User\PermissionController;

// Category controllers 
use App\Http\Controllers\PhoneBook\PhoneBookController;

// Setting (sitesetting)
use App\Http\Controllers\Setting\SiteSettingController;

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
Route::get('/', function () {
    return redirect()->route('auth.login');
});
Route::get('/login', [LoginController::class, 'login'])->name('auth.login');
Route::post('/login', [LoginController::class, 'login_go'])->name('auth.login.go');

Route::get('/register', [RegisterController::class, 'register'])->name('auth.register');
Route::post('/register', [RegisterController::class, 'create'])->name('auth.create_user');


Route::group(['middleware' => ['auth']], function() {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // Dashboard
    Route::prefix('dashboard')->group(function () {
        
        // Profile
        Route::get('/profile',          [ProfileController::class, 'profile'])->name('admin.profile');
        Route::post('/profile/update/', [ProfileController::class, 'update_profile'])->name('admin.profile.update');
        Route::post('/profile/password/update/', [ProfileController::class, 'update_password'])->name('admin.profile.password.update');

        Route::group(['middleware' => ['role:Admin']], function() {
            // Add User (Staff)
            Route::prefix('user')->group(function () {
                Route::get('/index',          [UserController::class, 'index'])->name('admin.user.index');
                Route::get('/create',         [UserController::class, 'create'])->name('admin.user.create');
                Route::post('/store',         [UserController::class, 'store'])->name('admin.user.store');
                Route::get('/edit/{id}',      [UserController::class, 'edit'])->name('admin.user.edit');
                Route::post('/update/{id}',   [UserController::class, 'update'])->name('admin.user.update');
                Route::get('/destroy/{id}',   [UserController::class, 'destroy'])->name('admin.user.destroy');
            });

            // Role
            Route::prefix('user/role')->group(function () {
                Route::get('/index',          [RoleController::class, 'index'])->name('admin.user.role.index');
                Route::get('/create',         [RoleController::class, 'create'])->name('admin.user.role.create');
                Route::post('/store',         [RoleController::class, 'store'])->name('admin.user.role.store');
                Route::get('/edit/{id}',      [RoleController::class, 'edit'])->name('admin.user.role.edit');
                Route::post('/update/{id}',   [RoleController::class, 'update'])->name('admin.user.role.update');
                Route::get('/destroy/{id}',   [RoleController::class, 'destroy'])->name('admin.user.role.destroy');

                // set permision on role
                Route::get('/set_permission/{id}',      [RoleController::class, 'set_permission'])->name('admin.user.role.set_permission');
                Route::post('/set_permission/update/{id}',   [RoleController::class, 'set_permission_update'])->name('admin.user.role.set_permission.update');
            });

            // Permission
            Route::prefix('user/permission')->group(function () {
                Route::get('/index',          [PermissionController::class, 'index'])->name('admin.user.permission.index');
                Route::get('/create',         [PermissionController::class, 'create'])->name('admin.user.permission.create');
                Route::post('/store',         [PermissionController::class, 'store'])->name('admin.user.permission.store');
                Route::get('/edit/{id}',      [PermissionController::class, 'edit'])->name('admin.user.permission.edit');
                Route::post('/update/{id}',   [PermissionController::class, 'update'])->name('admin.user.permission.update');
                Route::get('/destroy/{id}',   [PermissionController::class, 'destroy'])->name('admin.user.permission.destroy');
            });

            #setting
            Route::prefix('setting')->group(function () {
                Route::prefix('sitesetting')->group(function () {
                    Route::get('/dashboard',     [SiteSettingController::class, 'dashboard'])->name('admin.setting.sitesetting.dashboard');
                    Route::post('/dashboard/update',   [SiteSettingController::class, 'dashboard_update'])->name('admin.setting.sitesetting.dashboard_update');

                    Route::get('/frontend',     [SiteSettingController::class, 'frontend'])->name('admin.setting.sitesetting.frontend');
                    Route::post('/frontend/update',   [SiteSettingController::class, 'frontend_update'])->name('admin.setting.sitesetting.frontend_update');
                });
            });            

        });


        
        Route::group(['middleware' => ['role:Admin|User']], function() {

            // Phone Book
            Route::prefix('phone-book')->group(function () {
                Route::get('/index',          [PhoneBookController::class, 'index'])->name('phonebook.index');
                Route::get('/create',         [PhoneBookController::class, 'create'])->name('phonebook.create');
                Route::post('/store',         [PhoneBookController::class, 'store'])->name('phonebook.store');
                Route::get('/edit/{id}',      [PhoneBookController::class, 'edit'])->name('phonebook.edit');
                Route::post('/update/{id}',   [PhoneBookController::class, 'update'])->name('phonebook.update');
                Route::get('/destroy/{id}',   [PhoneBookController::class, 'destroy'])->name('phonebook.destroy');
                Route::get('/get_event',    [PhoneBookController::class, 'get_event'])->name('phonebook.get_event');
                Route::get('/status_update',[PhoneBookController::class, 'status_update'])->name('phonebook.status_update');
            });

        });


    });


    

    // Logout
    Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');



});



// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
