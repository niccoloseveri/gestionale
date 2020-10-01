<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Articles;
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
        $authorUser=User::where('name','author')->first();
        $article = Articles::create([
            'title'=>'prova',
            //'topic'=>'prova',
            'data_p'=>date('2020-10-10'),
            'ora_p'=>date('H:m:s',$timestamps=time()),
        ]);
        $article->users()->attach($authorUser);

    }
}
