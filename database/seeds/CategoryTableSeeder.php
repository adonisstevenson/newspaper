<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
    	$categories = [
    		['name'=>'politics'],
    		['name'=>'economy'],
    		['name'=>'world'],
    		['name'=>'law'],

    	];

        DB::table('categories')->insert($categories);
    }
}
