<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\ConceptUser;
use App\Concept;

class CommunityController extends Controller
{
    public function joinCommunity (Request $request) {
      return ConceptUser::firstOrCreate([
        'user_id' => Auth::id(),
        'concept_id' => $request->input('concept_id')
      ]);
    }
    public function leaveCommunity (Request $request) {
      return ConceptUser::where('user_id',Auth::id())->where('concept_id',$request->input('concept_id'))->delete();
    }
    public function checkJoined (Request $request) {
      return ConceptUser::where('user_id',Auth::id())->where('concept_id',$request->input('concept_id'))->exists();
    }
    public function countParticipants (Request $request) {
      return ConceptUser::where('concept_id',$request->input('concept_id'))->count();
    }
    public function queryCommunity (Request $request) {
      return Concept::where('layer',5)->firstWhere('id', $request->input('concept_id'));
    }
    public function isCommunity (Request $request) {
      return response()->json(5 === (Concept::find($request->input('concept_id')))->layer);
    }
    public function selectMembers (Request $request) {
      return ConceptUser::with('user')->where('concept_id',$request->input('concept_id'))->get();
    }
    public function queryJoinedCommunity (Request $request) {
      return ConceptUser::with('concept.user:id,name')->where('user_id',Auth::id())->get();
    }
}
