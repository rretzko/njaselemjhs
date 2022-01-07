<?php

namespace Database\Seeders;

use App\Models\Scoredefinition;
use Illuminate\Database\Seeder;

class ScoredefinitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            [1,1,1],
            [1,2,2],
            [2,1,3],
            [2,2,4],
            [2,3,5],
        ];

        foreach($seeds AS $seed){

            Scoredefinition::create([
               'scorecategory_id' => $seed[0],
               'scorecomponent_id' => $seed[1],
               'order_by' => $seed[2],
            ]);
        }
    }
}
