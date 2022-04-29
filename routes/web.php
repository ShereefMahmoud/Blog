<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userTypeController;
use App\Http\Controllers\articleCategoryController;
use App\Http\Controllers\userController;
use App\Http\Controllers\articleController;
use Illuminate\Support\Facades\DB;
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
    $data = DB::table('article')->join('user','user.id','=','user_id')->join('artical_category','artical_category.id','=','article_category_id')->select('article.*','user.name as userName','user.email as useremail','user.image as userImage','artical_category.category as articleCategory')->get();
    return view('blog',["data"=>$data]);
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
});



Route::resource('userType', userTypeController::class);
Route::resource('articleCategory', articleCategoryController::class);
Route::resource('user', userController::class);
Route::resource('article', articleController::class);

Route::get('/login',[userController::class,'login']);
Route::post('/Dologin',[userController::class,'Dologin']);
