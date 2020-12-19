<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;
use App\Concept;

class SiteMapController extends Controller
{
    public function index()
    {
        $sitemap = App::make("sitemap");
        $now = Carbon::now();
        $sitemap->add(URL::to('/'), $now, '1.0', 'monthly');
        foreach (['concept','cover','vote','priority'] as $value) {
          $sitemap->add(URL::to('/document/'.$value), $now, '0.9', 'monthly');
        }
        foreach (Concept::orderBy('start_rate', 'asc')->get() as $con) {
            $sitemap->add(URL::to('/concept/'.$con->id), $con->updated_at, '0.7', 'yearly');
        }
        return $sitemap->render('xml');
    }
}
