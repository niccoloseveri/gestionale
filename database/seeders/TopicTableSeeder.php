<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Topic;

class TopicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Topic::truncate();
        Topic::create(['name'=>'Grande Fratello VIP']);
        Topic::create(['name'=>'Avanti un Altro']);
        Topic::create(['name'=>"Barbara d'Urso"]);
        Topic::create(['name'=>"Amici"]);
        Topic::create(['name'=>"Uomini e Donne"]);
        Topic::create(['name'=>"Temptation Island"]);



    }
}
