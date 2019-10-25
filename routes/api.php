<?php

/* Setup CORS */
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Authorization,X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, X-Socket-Id");

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix'=>'v1','middleware' => ['json.response'],'namespace' => 'Api\v1'], function () {

    Route::group(['prefix'=>'auth'],function () {
        Route::post('register','Auth\RegisterController@register');
        Route::post('login','Auth\LoginController@login');
        Route::get('user','Auth\LoginController@show')->middleware('auth:api');
        Route::post('refresh','Auth\LoginController@refresh');
    });

    Route::apiResource('articles','ArticlesController')->only(['index','show']);
    Route::apiResource('categories','CategoriesController')->only(['index']);
    Route::apiResource('tags','TagsController')->only(['index']);

    Route::group(['middleware' => ['auth:api']],function () {

         //User Routes
         Route::apiResource('comments','CommentsController')->only(['index','show','store', 'update']);


         // Admin routes
         Route::middleware(['role:Admin'])->group(function(){
            Route::apiResource('articles','ArticlesController')->only(['store', 'update', 'destroy']);
            Route::apiResource('categories','CategoriesController')->only(['show','store', 'update', 'destroy']);
            Route::apiResource('tags','TagsController')->only(['show','store', 'update', 'destroy']);
            Route::apiResource('comments','CommentsController')->only(['destroy']);
         });

    });

});
