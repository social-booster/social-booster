<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Channel;
use App\Concept;
use App\ConceptUser;
use App\Cover;

class ChannelController extends Controller
{
    public static function insert($concept_id, $name)
    {
        Channel::create([
        'concept_id' => $concept_id,
        'name' => $name
      ]);
    }
    public function select(Request $request)
    {
        return Channel::where('concept_id', $request->input('concept_id'))->get();
    }
    public function query(Request $request)
    {
        return Channel::firstwhere('concept_id', $request->input('concept_id'));
    }
    public function canUserSend(Request $request)
    {
        $concept_id = (Channel::find($request->input('channel_id')))->concept_id;
        $layer = (Concept::find($concept_id))->layer;
        if ($layer === 5) {
            return ConceptUser::where('user_id', Auth::id())->where('concept_id', $concept_id)->exists();
        }
        return response()->json(
            count(array_intersect(
                (ConceptUser::where('user_id', Auth::id())->pluck('concept_id'))->toArray(),
                (Cover::where('lower_concept_id', $concept_id)->pluck('upper_concept_id'))->toArray()
            )) >= 1
        );
    }
}
