<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Concept;
use App\Cover;

class ProjectController extends Controller
{
    public function countEngagedCommunities(Request $request)
    {
        if (4 !== (Concept::find($request->input('concept_id')))->layer) {
            return 'is not community';
        }
        return Cover::where('lower_concept_id', $request->input('concept_id'))->count();
    }
    public function isProject (Request $request) {
      return 4 === (Concept::find($request->input('concept_id')))->layer;
    }
    public function queryProject (Request $request) {
      return Concept::where('layer',4)->firstWhere('id', $request->input('concept_id'));
    }
}
