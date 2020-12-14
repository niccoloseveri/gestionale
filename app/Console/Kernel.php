<?php

namespace App\Console;

use App\Models\Articles;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use SimplePie;
use willvincent\Feeds\Facades\FeedsFacade;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function(){
            $articles=Articles::all();
            $xmlString = file_get_contents('https://www.solodonna.it/feed');
            $xml = simplexml_load_string($xmlString);
            foreach($xml->children()->children() as $item){
                foreach($articles as $article){
                    if($item->title == $article->title && $article->published ==0){
                        $article->published = 1;
                        $article->save();
                    }
                }
            }
        })->everySixHours();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
