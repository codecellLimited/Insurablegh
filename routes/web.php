<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

/** ------------ Auth Routes
//  * ======================================*/
// Route::view('/', 'auth.login')->name('login.view');
// // user login
// Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
// // user logout
// Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');



Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    /**category cont*/
    
    Route:: controller(App\Http\Controllers\HomePageController::class)
    ->group(function(){
       Route::get('slider/images','showslider')->name('slider');
       Route::get('slider/create','createslider')->name('slider.create');
       Route::post('slider/store','storeslider')->name('slider.store');
       Route::get('slider/edit/{key}','editslider')->name('slider.edit');
       Route::post('slider/update','updateslider')->name('slider.update');
       Route::get('slider/delete/{key}', 'destroyslider')->name('slider.delete');


       //category 

       Route::get('category-list','showcategory')->name('category');
       Route::get('category/create', 'createcategory')->name('category.create');
       Route::post('category/store', 'storecategory')->name('category.store');
       Route::get('category/{key}', 'editcategory')->name('category.edit');
       Route::post('category/update', 'updatecategory')->name('category.update');
       Route::get('category/delete/{key}', 'destroycategory')->name('category.delete');


    });

/**-------------    Protected Route for admin panel
 * ========================================================*/
Route::middleware('auth')
->group(function(){


    
});