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

Route::group([], function (){

    Route::match(['get','post'], '/', ['uses' => 'IndexController@execute', 'as' => 'home']);
    Route::get('/page/{alias?}',['uses' => 'PageController@execute', 'as' => 'page']);

    Route::auth();

});

//admin
Route::group(['prefix' => 'admin','middleware' => 'auth'], function (){

    Route::get('/', function (){
        if(view()->exists('admin.index')){
            $data = array(
                'title' => 'Admin panel'
            );

//            return view('admin.index', $data);
            return redirect()->route('pages');
        }
    })->name('admin');

    Route::group(['prefix' => 'pages'], function (){

        Route::get('/', ['uses' => 'PagesController@execute','as' => 'pages']);
        Route::match(['get','post'], '/add', ['uses' => 'PagesAddController@execute', 'as' => 'pagesAdd']);
        Route::match(['get','post','delete'],'/edit/{page}',['uses' => 'PagesEditController@execute', 'as' => 'pagesEdit']);

    });

    Route::group(['prefix' => 'portfolios'], function (){

        Route::get('/', ['uses' => 'PortfolioController@execute','as' => 'portfolio']);
        Route::match(['get','post'], '/add', ['uses' => 'PortfolioAddController@execute', 'as' => 'portfolioAdd']);
        Route::match(['get','post','delete'],'/edit/{portfolio}',['uses' => 'PortfolioEditController@execute', 'as' => 'portfolioEdit']);

    });

    Route::group(['prefix' => 'services'], function (){

        Route::get('/', ['uses' => 'ServiceController@execute','as' => 'service']);
        Route::match(['get','post'], '/add', ['uses' => 'ServiceAddController@execute', 'as' => 'servicesAdd']);
        Route::match(['get','post','delete'],'/edit/{service}',['uses' => 'ServiceEditController@execute', 'as' => 'servicesEdit']);

    });

    Route::group(['prefix' => 'peoples'], function (){

        Route::get('/', ['uses' => 'PeopleController@execute','as' => 'people']);
        Route::match(['get','post'], '/add', ['uses' => 'PeopleAddController@execute', 'as' => 'peopleAdd']);
        Route::match(['get','post','delete'],'/edit/{people}',['uses' => 'PeopleEditController@execute', 'as' => 'peopleEdit']);

    });

    Route::get('upload_files', 'UploadFilesController@index')->name('upload_files');
    Route::post('upload_files', 'UploadFilesController@upload')->name('upload_files');

});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
