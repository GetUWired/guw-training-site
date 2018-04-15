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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/leaderboard', 'ProblemController@leaders')->name('leaders');

//Forms
Route::get('/add-problem', 'ProblemController@create')->name('createproblem')->middleware('auth');
Route::post('/save-problem', 'ProblemController@store')->name('saveproblem');
Route::get('/edit/{id}', 'ProblemController@edit')->name('editproblem')->middleware('auth');
Route::patch('/edit/{id}', 'ProblemController@update')->name('updateproblem')->middleware('auth');
Route::post('/problems/problem-completion', 'UserProblemController@store')->name('completeproblem');
Route::get('/problems/problem-completion-check', 'UserProblemController@problem_status')->name('problemstatus');

//Languages Routes
Route::get("/problems/{problem}", "ProblemController@index")->name('problems')->middleware('auth');
Route::get('/problem/{problem}', "ProblemController@show")->name('singleproblem')->middleware('auth');
Route::post('/problem/search', "ProblemController@search")->name('problem.search')->middleware('auth');


//Route::resource('sets', 'SetController')->middleware('auth');
Route::get('/sets', 'SetController@index')->middleware('auth');
Route::get('/sets/create', 'SetController@create')->middleware('auth')->name('setcreate');
Route::post('/sets/store', 'SetController@store')->middleware('auth')->name('setstore');
Route::get('/sets/edit/{set}', 'SetController@edit')->middleware('auth')->name('setedit');
Route::post('/sets/update/{set}', 'SetController@update')->middleware('auth')->name('setupdate');
Route::get('/sets/{id}', 'SetController@show')->middleware('auth')->name('singleset');
Route::post('/sets/problem-completion', 'UserProblemController@store')->name('completeproblem');
Route::post('/problem/problem-completion', 'UserProblemController@store')->name('completeproblem');