<?php

use App\Models\Memo;
use Illuminate\Database\Seeder;

class MemosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Memo::class, 10)->create();
    }
}
