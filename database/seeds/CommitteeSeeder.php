<?php

use Illuminate\Database\Seeder;
use App\Committee;

class CommitteeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data_seeds = [
            ['id'=> '1', 'name' => 'Manager'],
            ['id'=> '2', 'name' => 'Imam 1'],
            ['id'=> '2', 'name' => 'Imam 2'],
            ['id'=> '3', 'name' => 'Bilal'],
            ['id'=> '4', 'name' => 'Siak'],
            ['id'=> '5', 'name' => 'Secretary'],
            ['id'=> '6', 'name' => 'Treasurer'],
        ];

        foreach ($data_seeds as $seed) {
            Committee::firstOrCreate($seed);
        }
    }
}
