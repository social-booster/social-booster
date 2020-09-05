<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConceptVoteController;
use App\Http\Controllers\CoverVoteController;

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

Auth::routes(['verify' => true]);

Route::get('sitemap', 'SiteMapController@index');

Route::prefix('ajax')->group(function () {
//Auth
Route::get('check/auth', function (Request $request) {
  return response()->json(Auth::check());
});
Route::get('check/verified', function (Request $request) {
  return response()->json(Auth::check() ? Auth::user()->email_verified_at === null ? false : true : false);
});
Route::post('logout', function (Request $request) {
  return Auth::logout();
});
//User
Route::post('update/user', 'UserController@update');
Route::post('delete/user', 'UserController@delete');
Route::get('query/user/MyData', 'UserController@queryMyUserData');
//Concept
Route::post('insert/concept', 'ConceptController@insert');
Route::get('select/concept', 'ConceptController@select');
Route::get('query/concept', 'ConceptController@query');
Route::get('query/concept/StartRateRank', 'ConceptController@queryStartRateRank');
Route::get('serch/concept/similarity', 'ConceptController@similaritySearch');
//Cover
Route::post('insert/cover', 'CoverController@insert');
Route::get('select/cover', 'CoverController@select');
//ConceptVote
Route::post('insert/concept/vote', 'ConceptVoteController@insert');
Route::get('query/OneConceptVotes', function (Request $request) {
    return ConceptVoteController::countOneConceptVotes($request->input('user_id'), $request->input('concept_id'));
});
Route::get('query/allConceptVotes', 'ConceptVoteController@countAllConceptVotes');
//CoverVote
Route::post('insert/cover/vote', 'CoverVoteController@insert');
Route::get('query/PrivateAllCoverVotes', 'CoverVoteController@sumPrivateAllCoverVotes');
Route::get('query/privateOneCoverVotes', function (Request $request) {
    return CoverVoteController::sumPrivateOneCoverVotes($request->input('user_id'), $request->input('cover_id'));
});
//Community
Route::post('join/community', 'CommunityController@joinCommunity');
Route::post('leave/community', 'CommunityController@leaveCommunity');
Route::get('check/joined', 'CommunityController@checkJoined');
Route::get('query/Participants', 'CommunityController@countParticipants');
Route::get('query/community', 'CommunityController@queryCommunity');
Route::get('check/isCommunity', 'CommunityController@isCommunity');
Route::get('select/community/members', 'CommunityController@selectMembers');
//Project
Route::get('query/project/EngagedCommunities', 'ProjectController@countEngagedCommunities');
Route::get('check/isProject', 'ProjectController@isProject');
Route::get('query/project', 'ProjectController@queryProject');
//Channel
Route::get('select/channel', 'ChannelController@select');
Route::get('query/channel', 'ChannelController@query');
Route::get('check/channel/CanUserSend', 'ChannelController@canUserSend');
//Message
Route::post('insert/message', 'MessageController@insert');
Route::get('select/message', 'MessageController@select');
//Recaptcha
Route::get('query/recaptcha/SiteKey', function (Request $request) {
    return response()->json(config('recaptcha.site-key'));
});
//Watch
Route::post('insert/watch', 'WatchController@insert');
Route::post('delete/watch', 'WatchController@delete');
Route::get('check/watch', 'WatchController@checkWatch');
});

Route::get('{any}', function () {
    return view('index');
})->where('any', '.*');
