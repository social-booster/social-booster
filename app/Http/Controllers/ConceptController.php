<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RecaptchaRequest;
use App\Concept;
use App\Http\Controllers\ChannelController;

class ConceptController extends Controller
{
    public function insert (RecaptchaRequest $request) {
      $response = Concept::create([
        'user_id' => $request->boolean('anonymous') ? null : Auth::id(),
        'layer' => $request->input('layer'),
        'name' => $request->input('name'),
        'content' => $request->input('content'),
      ]);
      if ($response->layer === 4 OR $response->layer === 5) {
          ChannelController::insert($response->id,'ミーティングルーム');
      }
      return $response;
    }
    public function select (Request $request) {
      return Concept::with('user:id,name')
                ->when($request->input('exclusion_layer') !== null, function ($query) use ($request) {
                    return $query->whereNotIn('layer', $request->input('exclusion_layer'));
                })
                ->when($request->boolean('my_concept_only'), function ($query) {
                    return $query->where('concepts.user_id', Auth::id());
                })
                ->when($request->boolean('my_concept_only'), function ($query) {
                    return $query->where('concepts.user_id', Auth::id());
                })
                ->when($request->boolean('voted_concepts'), function ($query) {
                    return $query->where('concept_real_votes.user_id', Auth::id())
                                  ->rightJoin('concept_real_votes', 'concepts.id', '=', 'concept_real_votes.concept_id');
                })
                ->when($request->boolean('joined_community'), function ($query) {
                    return $query->where('concept_users.user_id', Auth::id())
                                  ->rightJoin('concept_users', 'concepts.id', '=', 'concept_users.concept_id');
                })
                ->when($request->boolean('watching_concepts'), function ($query) {
                    return $query->where('watches.user_id', Auth::id())
                                  ->rightJoin('watches', 'concepts.id', '=', 'watches.concept_id');
                })
                ->orderBy('concepts.start_rate', 'asc')
                ->orderBy('concepts.additional_votes_ratio', 'desc')
                ->offset($request->input('page') * 10 - 10)
                ->limit(10)
                ->when($request->boolean('voted_concepts') OR $request->boolean('joined_community') OR $request->boolean('watching_concepts'), function ($query) {
                    return $query->select('concepts.*');
                })
                ->get();
    }
    public function query(Request $request) {
      return Concept::with('user:id,name')->FindOrFail($request->input('concept_id'));
    }
    public function serchSimilarities(Request $request) {
      return Concept::where('layer',$request->input('layer'))->freeword($request->input('content'))->limit(5)->get();
    }
    public function queryStartRateRank(Request $request) {
      $ranking = [];
      $rank = 1;
      foreach (Concept::orderBy('start_rate', 'asc')->orderBy('additional_votes_ratio', 'desc')->get() as $con) {
        $ranking[$con->id] = $rank++;
      }
      return $ranking[$request->input('concept_id')];
    }
}
