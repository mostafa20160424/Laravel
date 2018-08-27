<?php

use Illuminate\Database\Seeder;
use App\News; //use Model
class NewsDB extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i <10 ; $i++) {
          $add = new News();
          $add->title = 'news title'.rand(0,9);
          $add->Add_by=1;
          $add->description='news contetn'.rand(0,9);
          $add->statues='active';
          $add->save();
        }
        // call the class in DatabaseSeeder in function run write $this->call(NewsDB::class);
        //then do "php artisan db:seed" and the values will insert to database
    }
}
