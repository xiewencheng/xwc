<?php

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
    return view('welcome');
});
//Route::any('class/add','ClassControllers@Index');
//
//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');
//
//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/home','StaticController@home')->name('home');
//
//Route::get('/help','StaticController@help')->name('help');
//
//Route::get('/about','StaticController@about')->name('about');
//
//Route::get('/haha','HahaController@lun');
//Route::get('/signup','UserController@create')->name('signup');
Route::group(['Admin'=>"sss"],function(){
    Route::get('/login8','Admin\LoginController@index')->name('layouts.login');
    Route::get('/logindo','Admin\LoginController@login')->name('layouts.login');
    Route::any('/show','Admin\ListController@index')->name('layouts.list');
    Route::any('/olist','Admin\ListController@olist')->name('layouts.olist');
    Route::any('/add','Admin\ListController@add')->name('layouts.add');
    Route::any('/addto','Admin\ListController@addto')->name('layouts.add');
    Route::any('/cate','Admin\ListController@cate')->name('layouts.cate');
    Route::any('/subtopic','Admin\ListController@subtopic')->name('layouts.subtopic');
    Route::any('/subtopicto','Admin\ListController@subtopicto')->name('layouts.subtopic');
    Route::any('/save','Admin\ListController@save');
    Route::any('/sate','Admin\ListController@sate');
    Route::any('/listdel','Admin\ListController@listdel');
    Route::any('/listdelall','Admin\ListController@listdelall');
    Route::any('/gemlist','Admin\GementController@index')->name('layouts.gemlist');
    Route::any('/adminadd','Admin\GementController@adminadd')->name('layouts.adminadd');
    Route::any('/adminaddto','Admin\GementController@adminaddto');
    Route::any('/role','Admin\GementController@role')->name('layouts.role');
    Route::any('/power','Admin\GementController@power')->name('layouts.power');
    Route::any('/powerto','Admin\GementController@powerto');
    Route::any('/pocate','Admin\GementController@pocate')->name('layouts.pocate');
    Route::any('/Pocateadd','Admin\GementController@Pocateadd');
    Route::any('/rule','Admin\GementController@rule')->name('layouts.rule');
    Route::any('/ruleadd','Admin\GementController@ruleadd');
    Route::any('/del','Admin\GementController@del');
    Route::any('/email','EmailController@index')->name('emails');
});

Route::group(['Desk'=>"ddd"],function()
{
    Route::get('/index89','Desk\FrontController@index')->name("front.desk");
    Route::any('/login89','Desk\LoginController@login')->name('front.login');
    Route::any('/registered','Desk\LoginController@registered')->name('front.registered');
});
//Route::get('aaa','ListController@add')->name('signup');

//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
