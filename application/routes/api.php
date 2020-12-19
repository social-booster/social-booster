<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ConceptVoteController;
use App\Http\Controllers\CoverVoteController;

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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
/*
if (fasle) {
Route::group(['middleware' => ['api']], function () {
      //Auth
      Route::get('check/auth', function (Request $request) {
          return response()->json(Auth::check());
      });
      //User
      Route::get('user/query/mydata', 'UserController@queryMyUserData');
});
}
*/
/*
Route::group(['middleware' => ['web']], function () {
    if (true) {
        //Concept
        Route::post('insert/concept', 'ConceptController@insert');
        //Cover
        Route::post('insert/cover', 'CoverController@insert');
        //ConceptVote
        Route::post('insert/concept/vote', 'ConceptVoteController@insert');
        //CoverVote
        Route::post('insert/cover/vote', 'CoverVoteController@insert');
    }
});
*/
