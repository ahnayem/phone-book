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
                Route::get('/destroy/{id}',   [UserController::class, 'destroy'])->name('admin.user.destroy');
            });

            #setting
            Route::prefix('setting')->group(function () {
                Route::prefix('sitesetting')->group(function () {
                    Route::get('/dashboard',     [SiteSettingController::class, 'dashboard'])->name('admin.setting.sitesetting.dashboard');
                    Route::post('/dashboard/update',   [SiteSettingController::class, 'dashboard_update'])->name('admin.setting.sitesetting.dashboard_update');
                });
            });            

        });


        
        // Phone Book
        Route::prefix('phone-book')->group(function () {
            Route::get('/index',          [PhoneBookController::class, 'index'])->name('phonebook.index');
            Route::get('/create',         [PhoneBookController::class, 'create'])->name('phonebook.create');
            Route::post('/store',         [PhoneBookController::class, 'store'])->name('phonebook.store');
            Route::get('/edit/{id}',      [PhoneBookController::class, 'edit'])->name('phonebook.edit');
            Route::post('/update/{id}',   [PhoneBookController::class, 'update'])->name('phonebook.update');
            Route::get('/destroy/{id}',   [PhoneBookController::class, 'destroy'])->name('phonebook.destroy');
            Route::get('/get_event',      [PhoneBookController::class, 'get_event'])->name('phonebook.get_event');
            Route::get('/favourite_update',[PhoneBookController::class, 'favourite_update'])->name('phonebook.favourite_update');

            
            Route::get('/favourite-list',[PhoneBookController::class, 'favourite_list'])->name('phonebook.favourite_list');
            
        });


    });


    

    // Logout
    Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');



});



// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
