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
        Topic::create(['t_name'=>'Grande Fratello VIP']);
        Topic::create(['t_name'=>'Avanti un Altro']);
        Topic::create(['t_name'=>"Barbara d'Urso"]);
        Topic::create(['t_name'=>"Amici"]);
        Topic::create(['t_name'=>"Uomini e Donne"]);
        Topic::create(['t_name'=>"Temptation Island"]);



    }
}
