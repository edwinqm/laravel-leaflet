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
        $admin->name = 'Administrator';
        $admin->username = 'admin';
        $admin->email = 'admin@domain.com';
        $admin->password = bcrypt('123456');
        $admin->save();

        $admin->profile()->create([
            'address' => $faker->address, 
            'phone' => $faker->phoneNumber, 
            'avatar' => '',
            'birthday' => $faker->date(),
        ]);

        for ($i = 1; $i <= 5; $i++) {

            $user = new User();
            $user->name = $faker->name;
            $user->username = $faker->userName;
            $user->email = $faker->email;
            $user->password = bcrypt('123456');
            $user->save();

            $user->profile()->create([
                'address' => $faker->address, 
                'phone' => $faker->phoneNumber, 
                'avatar' => '',
                'birthday' => $faker->date(),
            ]);

        }

    }

}
