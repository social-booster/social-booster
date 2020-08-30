<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConceptVote;
use Illuminate\Support\Facades\Artisan;

class ConceptVoteController extends Controller
{
    public function insert(Request $request)
    {
        $user_id = $request->input('user_id');
        $value = $request->input('value');
        $concept_id = $request->input('concept_id');

        $result = self::countOneConceptVotes($user_id, $concept_id) + $value;

        if ($result < 0) {
            return 0;
        }

        ConceptVote::create([
        'user_id' => $user_id,
        'value' => $value,
        'concept_id' => $concept_id
      ]);
        Artisan::call('sb:ComputeAll');
        return response()->json($result);
    }
    public static function countOneConceptVotes($user_id, $concept_id): int
    {
        return ConceptVote::where('user_id', $user_id)->where('concept_id', $concept_id)->sum('value');
    }
    public function countAllConceptVotes(Request $request): int
    {
        return ConceptVote::where('user_id', $request->input('user_id'))->sum('value');
    }
}
