<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RecaptchaRequest;
use App\Cover;

class CoverController extends Controller
{
    public function insert(RecaptchaRequest $request)
    {
        Cover::create([
          'user_id' => $request->input('user_id'),
          'upper_concept_id' => $request->input('upper_concept_id'),
          'lower_concept_id' => $request->input('lower_concept_id'),
        ]);
    }
    public function select(Request $request)
    {
        return Cover::with(($request->input('mode') === 'upper' ? 'upper' : 'lower').'_concept.user:id,name')
        ->where(($request->input('mode') === 'upper' ? 'lower' : 'upper').'_concept_id',$request->input('concept_id'))->get();
    }
}
