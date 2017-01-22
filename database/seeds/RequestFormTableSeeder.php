<?php

use Illuminate\Database\Seeder;

class RequestFormTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\RequestForm::class, 10)->create();
    }
}
