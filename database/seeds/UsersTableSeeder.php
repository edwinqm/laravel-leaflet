<?php

use Illuminate\Database\Seeder;
use \App\User;
use \Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Model::unguard();

        $faker = Faker\Factory::create();

        $admin = new User();
        $admin->name = 'admin';
        $admin->email = 'admin@domain.com';
        $admin->birthday = $faker->date();
        $admin->password = bcrypt('123456');
        $admin->save();

        $admin->profile()->create([
            'name' => 'Administrator',
            'avatar' => '',
        ]);
        
        for ($i = 1; $i <= 37; $i++) {

            $user = new User();
            $user->name = $faker->name;
            $user->email = $faker->email;
            $user->birthday = $faker->date();
            $user->password = bcrypt('123456');
            $user->save();

            $user->profile()->create([
                'name' => 'User '.$i,
                'avatar' => '',
            ]);
            
        }

    }
    
}
