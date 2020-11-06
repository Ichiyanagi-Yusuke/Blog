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

//一覧表示
Route::get('/','BlogController@showList')->name('blogs');
//登録画面の表示
Route::get('/blog/create','BlogController@showCreate')->name('create');
//登録
Route::post('/blog/store','BlogController@exeStore')->name('store');
//詳細表示
Route::get('/blog/{id}','BlogController@showDetail')->name('show');
//編集画面
Route::get('/blog/edit/{id}','BlogController@showEdit')->name('edit');
//更新
Route::post('/blog/update','BlogController@exeUpdate')->name('update');
//削除
Route::post('/blog/delete/{id}','BlogController@exeDelete')->name('delete');



/*
|---------------------------------------------------------------------------
| レンタル票
|---------------------------------------------------------------------------
*/
Route::get('/rental','RentalController@rentalIndex')->name('rental');
