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
//Route::middleware("")->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::prefix('/quotes' )->group(function (){
    //Возвращает все цитаты c тегами
    Route::get('/',[QuoteController::class, 'getQuotes']);

    Route::post('/add',[QuoteController::class, 'addQuote'])->middleware(\App\Http\Middleware\ForceJsonResponse::class);
});


//Массив связанных цитат с их тегами
Route::get('/quote_tags',[Quote_tagController::class, 'getQuote_tags']);


Route::prefix('/tags' )->group(function (){
    //Массив всех доступных тегов постранично по 10
    Route::get('/',[TagController::class, 'getAllTags']);
    //Массив всех доступных тегов со связанными цитатами постранично по 10
    Route::get('/relation',[TagController::class, 'getTagsRelation']);
});




