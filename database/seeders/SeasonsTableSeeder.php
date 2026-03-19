<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeasonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
       $seasons=[
        ['name'=>'春'],
        ['name'=>'夏'],
        ['name'=>'秋'],
        ['name'=>'冬'],
       ];
       
         foreach($seasons as $season){
          \App\Models\Season::create($season);
         }
    }
}
