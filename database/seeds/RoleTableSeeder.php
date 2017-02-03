<?php

use \Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'admin',
            'description' => 'Admin Role',
        ]);
        DB::table('roles')->insert([
            'name' => 'author',
            'description' => 'Author Role',
        ]);
        DB::table('roles')->insert([
            'name' => 'visitor',
            'description' => 'Visitor Role',
        ]);
    }
}
