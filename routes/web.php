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

Route::get('/', [App\Http\Controllers\stories\FrontStoriesController::class, 'allstories'])->name('welcome');
//STORY COMMENT ROUTE
Route::get('/singleStory/{slug}', [App\Http\Controllers\stories\FrontStoriesController::class, 'singleStory'])->name('single-story');
Route::post('/singleStory/savecomment/{id}', [App\Http\Controllers\stories\FrontStoriesController::class, 'addComment'])->name('save-comment');
Route::post('/singleStory/saveReply/{id}', [App\Http\Controllers\stories\FrontStoriesController::class, 'saveReply'])->name('save-reply');



Auth::routes();

Route::group(['prefix'=>'dashboard','middleware' => 'auth'], function() {
    // DASHBOARD ROUTES
    Route::get('/', [App\Http\Controllers\dashboard\GeneralController::class, 'index'])->name('home');
    Route::get('stories/index', [App\Http\Controllers\dashboard\StoriesController::class, 'index'])->name('index');
    Route::get('stories/create', [App\Http\Controllers\dashboard\StoriesController::class, 'create'])->name('create');
    Route::post('stories/store', [App\Http\Controllers\dashboard\StoriesController::class, 'store'])->name('store');
    Route::get('stories/edit/{slug}', [App\Http\Controllers\dashboard\StoriesController::class, 'edit'])->name('edit');
    Route::post('stories/update/{slug}', [App\Http\Controllers\dashboard\StoriesController::class, 'update'])->name('update');
    Route::get('stories/delete/{slug}', [App\Http\Controllers\dashboard\StoriesController::class, 'destroy'])->name('delete');

    // STORY CATEGORY ROUTES
    Route::get('category/allstoriescat', [App\Http\Controllers\dashboard\GeneralController::class, 'storiesblogs'])->name('allstorycats');
    Route::post('category/saveblogcat', [App\Http\Controllers\dashboard\GeneralController::class, 'saveblogCat'])->name('add-blog-category');
    Route::post('category/updateblogcat/{slug}', [App\Http\Controllers\dashboard\GeneralController::class, 'updateblogCat'])->name('updateCat');
    Route::get('category/deleteblogcat/{slug}', [App\Http\Controllers\dashboard\GeneralController::class, 'deleteblogCat'])->name('deleteblogCat');

    
    // LIKE AND DISLIKE ROUTES
    Route::post('/like', [App\Http\Controllers\LikeController::class, 'like'])->name('like');
    Route::delete('/unlike', [App\Http\Controllers\LikeController::class, 'unlike'])->name('unlike');

});
