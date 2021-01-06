<?php

use App\Article;
use App\Job;
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

Route::get('/', function () {
    $Articles = Article::where('status_article_id', '1')->take(9)->get();
    $Jobs = Job::all();
    return view('landing_page.welcome', compact('Articles', 'Jobs'));
})->name('welcome');

Route::resource('post', 'PostController');
Route::get('/post/{id}/show', 'PostController@show');

Auth::routes();

// Role_id
// 1 = Admin
// 2 = Member
// 3 = Reporter

//CKEDITOR Filemanager
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

//CKEDITOR Upload Image
Route::post('ckeditor/upload', 'TicketController@upload')->name('upload.upload');
Route::post('ckeditor/store', 'TicketController@store')->name('upload.store');
Route::post('ckeditor/update{$id}', 'TicketController@update')->name('upload.update');

Route::group(['middleware' => ['auth', 'CekRole:1,2,3']], function () {
    //filter status
    Route::get('/project/{id}/filter_status_open', 'TicketController@filter_status_open');
    Route::get('/project/{id}/filter_status_closed', 'TicketController@filter_status_closed');

    Route::put('profile/password', 'ProfileController@changePassword')->name('profile.password');
    Route::get('/article/{id}/show', 'ArticleController@show');

    //ticket
    Route::get('/project/ticket', 'TicketController@index');
    Route::get('/project/ticket/create', 'TicketController@create');
    Route::post('/project/ticket', 'TicketController@store');
    Route::get('/project/ticket/{id}/edit', 'TicketController@edit');
    Route::put('/project/ticket/{id}', 'TicketController@update');
    Route::get('/project/ticket/{id}/show', 'TicketController@show');
    Route::delete('/project/ticket/{id}', 'TicketController@destroy');
});

Route::group(['middleware' => ['auth', 'CekRole:1,2']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('article', 'ArticleController');

    //project
    Route::get('/project', 'Admin\ProjectController@index');
    Route::get('/project/{id}/ticket', 'Admin\ProjectController@show');

    //profile
    Route::resource('profile', 'ProfileController');
    Route::resource('image-profile', 'ImageProfileController');

    //comment system
    Route::resource('comment', 'CommentController');
    Route::resource('comment-reply', 'CommentReplyController');
});

Route::group(['middleware' => ['auth', 'CekRole:1']], function () {
    Route::resource('manage-member', 'Admin\ManageMemberController');
    Route::resource('category-project', 'Admin\CategoryProjectController');
    Route::resource('laporan', 'Admin\LaporanController');

    //Data setting
    Route::resource('description', 'Admin\Setting\DescriptionController');
    Route::resource('role', 'Admin\Setting\RoleController');
    Route::resource('job', 'Admin\Setting\JobController');
    Route::resource('priority', 'Admin\Setting\PriorityController');
    Route::resource('status', 'Admin\Setting\StatusController');
    Route::resource('setting', 'Admin\Setting\SettingController');

    //Export PDF and Excel
    Route::get('/exportExcel', 'Admin\LaporanController@exportExcel')->name('exportExcel');
    Route::get('/exportPDF', 'Admin\LaporanController@exportPDF')->name('exportPDF');

    //Project
    Route::get('/project/create', 'Admin\ProjectController@create');
    Route::post('/project', 'Admin\ProjectController@store');
    Route::get('/project/{id}/edit', 'Admin\ProjectController@edit');
    Route::put('/project/{id}', 'Admin\ProjectController@update');
    Route::delete('/project/{id}', 'Admin\ProjectController@destroy');
});
