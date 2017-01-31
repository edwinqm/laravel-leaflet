<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Books', 
            'description' => '', 
        ]);
        DB::table('categories')->insert([
            'name' => 'Technology', 
            'description' => '', 
        ]);
        DB::table('categories')->insert([
            'name' => 'Food', 
            'description' => '', 
        ]);
        DB::table('categories')->insert([
            'name' => 'Sports', 
            'description' => '', 
        ]);
        DB::table('categories')->insert([
            'name' => 'Cars', 
            'description' => '', 
        ]);
    }
}
