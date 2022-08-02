<?php

use App\Http\Controllers\Quote_tagController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

Route::prefix('/quotes' )->group(function (){
    //Возвращает все(или по фильтрам) цитаты c тегами
    Route::get('/',[QuoteController::class, 'getQuotes'])->middleware(\App\Http\Middleware\ForceJsonResponse::class);
    //Добавить цитату
    Route::post('/add',[QuoteController::class, 'addQuote'])->middleware(\App\Http\Middleware\ForceJsonResponse::class);
});


//Возвращает все(или по фильтрам) цитаты с их тегами
Route::get('/quote_tags',[Quote_tagController::class, 'getQuoteTags'])->middleware(\App\Http\Middleware\ForceJsonResponse::class);

Route::prefix('/tags' )->group(function (){
    //Возвращает все(или по фильтрам) доступные теги постранично по 10
    Route::get('/',[TagController::class, 'getTags'])->middleware(\App\Http\Middleware\ForceJsonResponse::class);
    //Возвращает все(или по фильтрам) доступные теги со связанными цитатами постранично по 10
    Route::get('/relation',[TagController::class, 'getTagsRelation'])->middleware(\App\Http\Middleware\ForceJsonResponse::class);
});




