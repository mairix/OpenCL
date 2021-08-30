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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get( 'results', [App\Http\Controllers\ResultsController::class, 'index'] )->name('results')->middleware('auth');

Route::resource( 'chapters', 'App\Http\Controllers\ChaptersController' )
    ->names([ 
        'index' => 'chapters',
        'show' => 'chapters.show',
        'store' => 'chapters.store',
        'edit' => 'chapters.edit',
        'destroy' => 'chapters.delete',
    ])->middleware('auth');
Route::get('chapters/publish/{id}', [App\Http\Controllers\ChaptersController::class, 'publish'])->name('chapters.publish')->middleware('admin');
Route::get('chapters/unpublish/{id}', [App\Http\Controllers\ChaptersController::class, 'unpublish'])->name('chapters.unpublish')->middleware('admin');
Route::post('co', [App\Http\Controllers\ChaptersController::class, 'changeOrder'])->name('chapters.order')->middleware('admin');

Route::resource( 'questions', 'App\Http\Controllers\QuestionsController' )
    ->names([
        'index' => 'questions',
        'show' => 'questions.show',
        'store' => 'questions.store',
        'edit' => 'questions.edit',
        'destroy' => 'questions.delete',
    ])->middleware('admin');

Route::resource( 'answers', 'App\Http\Controllers\AnswersController' )
    ->names([
        'index' => 'answers',
        'store' => 'answers.store',
    ])
    ->middleware('auth');
    
Route::resource( 'users', 'App\Http\Controllers\UsersController' )
    ->names([
        'index' => 'users',
        'destroy' => 'users.delete',
    ])
    ->middleware('admin');
Route::post('users/restore/{id}', [App\Http\Controllers\UsersController::class, 'restore'])->name('users.restore')->middleware('admin');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');