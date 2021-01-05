<?php

use App\Article;
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
    $Articles = Article::where('status_article_id', '1')->get();
    return view('welcome', compact('Articles'));
});

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
    Route::get('filter_status_open', 'TicketController@filter_status_open');
    Route::get('filter_status_closed', 'TicketController@filter_status_closed');
    Route::put('profile/password', 'ProfileController@changePassword')->name('profile.password');
    Route::get('/article/{id}/show', 'ArticleController@show');
    // Route::resource('ticket', 'TicketController');

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
    Route::resource('comment', 'CommentController');
    Route::resource('profile', 'ProfileController');
    Route::resource('article', 'ArticleController');

    Route::get('/project', 'Admin\ProjectController@index');
    Route::get('/project/{id}/ticket', 'Admin\ProjectController@show');

    Route::resource('image-profile', 'ImageProfileController');
    Route::resource('comment-reply', 'CommentReplyController');
});

Route::group(['middleware' => ['auth', 'CekRole:1']], function () {
    Route::resource('role', 'Admin\RoleController');
    Route::resource('job', 'Admin\JobController');
    Route::resource('category-project', 'Admin\CategoryProjectController');
    Route::resource('priority', 'Admin\PriorityController');
    Route::resource('status', 'Admin\StatusController');
    Route::resource('manage-member', 'Admin\ManageMemberController');
    Route::resource('setting', 'Admin\SettingController');
    Route::resource('laporan', 'Admin\LaporanController');

    //Export PDF and Excel
    Route::get('/exportExcel', 'Admin\LaporanController@exportExcel')->name('exportExcel');
    Route::get('/exportPDF', 'Admin\LaporanController@exportPDF')->name('exportPDF');
    // Route::resource('project', 'Admin\ProjectController');

    //Project
    Route::get('/project/create', 'Admin\ProjectController@create');
    Route::post('/project', 'Admin\ProjectController@store');
    Route::get('/project/{id}/edit', 'Admin\ProjectController@edit');
    Route::put('/project/{id}', 'Admin\ProjectController@update');
    Route::delete('/project/{id}', 'Admin\ProjectController@destroy');
});
