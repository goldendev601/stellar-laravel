<?php

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
Route::match(['post', 'get'],"/join-waiting-list", "API\WaitingListController@index");
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('conversations')->group(
    function () {
        Route::get('/members', [App\Http\Controllers\ConversationController::class, 'membersWithConversation']);
        Route::get('member/{id}', [App\Http\Controllers\ConversationController::class, 'fetchConversationsForMemberId']);
        Route::post('/send', [App\Http\Controllers\ConversationController::class, 'sendSms']);
        Route::post('/start', [App\Http\Controllers\ConversationController::class, 'startConversation']);

    });
Route::get('/members-with-no-conversation', [App\Http\Controllers\ConversationController::class, 'membersWithNoConversation']);
Route::post('/make-inquire', [App\Http\Controllers\InquireController::class, 'makeInquire']);
Route::post('/validate/member', [App\Http\Controllers\InquireController::class, 'validateMember']);
