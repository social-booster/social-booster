<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\CoverVote;
use App\Cover;

class CoverVoteController extends Controller
{
    public function insert(Request $request): int
    {
        $user_id = $request->input('user_id');
        $value = $request->input('value');
        $cover_id = $request->input('cover_id');

        $result = self::sumPrivateOneCoverVotes($user_id, $cover_id) + $value;

        if ($result < 0) {
            return 0;
        }

        CoverVote::create([
          'user_id' => $user_id,
          'value' => $value,
          'cover_id' => $cover_id
        ]);

        Artisan::call('sb:ComputeAll');
        return $result;
    }
    public static function sumPrivateOneCoverVotes($user_id, $cover_id): int
    {
        return CoverVote::where('user_id', $user_id)->where('cover_id', $cover_id)->sum('value');
    }
    public function sumPrivateAllCoverVotes(Request $request): int
    {
        return CoverVote::join('covers', 'cover_votes.cover_id', '=', 'covers.id')
                      ->where('cover_votes.user_id', $request->input('user_id'))
                      ->where('covers.lower_concept_id',Cover::where('id', $request->input('cover_id'))->value('lower_concept_id'))
                      ->sum('cover_votes.value');
    }
}
