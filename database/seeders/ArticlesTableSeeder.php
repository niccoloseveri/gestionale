<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Articles;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Articles::truncate();
        DB::table('articles_user')->truncate();
        $adminUser=User::where('name','admin')->first();
        $topics=Topic::all();
        $i=0;
        foreach ($topics as $topic) {
            $i+=1;
            $article = Articles::create([
                'title'=>'Articolo di prova'.$i.'',
                //'topic'=>'prova',
                'data_p'=>date('2020-10-10'),
                'ora_p'=>date('H:m:s',$timestamps=time()),

            ]);
            $article->topic()->attach($topic);
            $article->users()->attach($adminUser);
        }
      /* $article = Articles::create([
            'title'=>'prova',
            //'topic'=>'prova',
            'data_p'=>date('2020-10-10'),
            'ora_p'=>date('H:m:s',$timestamps=time()),
        ]);
        $article->users()->attach($adminUser);*/

    }
}
