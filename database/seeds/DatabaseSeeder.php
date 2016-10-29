<?php

use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'rosemalejohn@gmail.com',
            'password' => bcrypt('rosemalejohn'),
            'id_number' => '233213',
            'name' => 'Rosemale-John II C. Villacorta',
            'department_id' => null,
            'type' => 'admin',
            'position' => 'Super admin',
            'gender' => 'male',
        ]);

        User::create([
            'email' => 'cobrador.kszyrver@gmail.com',
            'password' => bcrypt('kszyrvercobrador'),
            'id_number' => '2016-10-09-ID',
            'name' => 'Kszyr Ver Cobrador',
            'department_id' => null,
            'type' => 'admin',
            'position' => 'Super admin',
            'gender' => 'male',
        ]);

        User::create([
            'email' => 'user@fake.com',
            'password' => bcrypt('staffuser'),
            'id_number' => '103956',
            'name' => 'Julie Pantano',
            'department_id' => null,
            'type' => 'staff',
            'position' => 'Staff',
            'gender' => 'female',
        ]);
    }
}
