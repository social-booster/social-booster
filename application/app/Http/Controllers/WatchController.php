<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Watch;

class WatchController extends Controller
{
    public function insert (Request $request) {
      Watch::firstOrCreate(
        ['user_id' => Auth::id(),'concept_id' => $request->input('concept_id')],
        ['user_id' => Auth::id(),'concept_id' => $request->input('concept_id')]
      );
      return self::checkWatch($request->input('concept_id'));
    }
    public function delete (Request $request) {
      Watch::where('user_id',Auth::id())->where('concept_id',$request->input('concept_id'))->delete();
      return self::checkWatch($request->input('concept_id'));
    }
    public static function checkWatch ($concept_id): bool {
      return Auth::check() ? Watch::where('user_id',Auth::id())->where('concept_id',$concept_id)->exists() : false ;
    }
}
