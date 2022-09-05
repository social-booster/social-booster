<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap as Map;
use Spatie\Sitemap\Tags\Url;
use App\Concept;

class SiteMap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sitemap = Map::create(config('app.url'));
        $sitemap->add(Url::create('/')->setPriority(1));

        foreach (['outline', 'intention', 'concept', 'cover', 'vote', 'priority'] as $slug) {
            $sitemap->add(Url::create("/document/$slug")->setPriority(0.9));
        }
        foreach (Concept::orderBy('start_rate', 'asc')->get() as $concept) {
            $sitemap->add(Url::create("/concept/$concept->id")->setPriority(0.7));
        }

        $sitemap->writeToFile(public_path('sitemap'));
    }
}
