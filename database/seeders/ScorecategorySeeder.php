<?php

namespace Database\Seeders;

use App\Models\Scorecategory;
use Illuminate\Database\Seeder;

class ScorecategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Scorecategory::create([
           'name' => 'vocalise',
           'order_by' => 1,
        ]);

        Scorecategory::create([
            'name' => 'solo',
            'order_by' => 2,
        ]);


    }
}
