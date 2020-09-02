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
                ->orderBy('start_rate', 'asc')
                ->orderBy('additional_votes_ratio', 'desc')
                ->offset($request->input('page') * 10 - 10)
                ->limit(10)
                ->get();
    }
    public function query(Request $request) {
      return Concept::with('user:id,name')->FindOrFail($request->input('concept_id'));
    }
    public function similaritySearch(Request $request) {
      return Concept::where('layer',$request->input('layer'))->freeword($request->input('content'))->limit(5)->get();
    }
}
