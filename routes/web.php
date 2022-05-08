<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userTypeController;
use App\Http\Controllers\articleCategoryController;
use App\Http\Controllers\userController;
use App\Http\Controllers\articleController;
use App\Http\Controllers\commentController;
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
    $count_user = DB::table('user')->count();
    $count_cat = DB::table('article')->count();
    $count_comment = DB::table('comment')->count();
    return view('dashboard.index',["count_user"=>$count_user,'count_cat'=>$count_cat,'count_comment'=>$count_comment]);
})->middleware(['checkUser','checkAdmin']);



Route::resource('userType', userTypeController::class);
Route::resource('articleCategory', articleCategoryController::class);
Route::resource('user', userController::class);
Route::resource('article', articleController::class);
Route::resource('comment', commentController::class);

Route::get('/login',[userController::class,'login']);
Route::post('/Dologin',[userController::class,'Dologin']);


Route::get('/logout',function(){
    auth()->logout();
    return redirect(url('login'));
})->middleware(['checkUser']);
