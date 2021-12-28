<?php

namespace Database\Seeders;

use App\Models\Ensemble;
use Illuminate\Database\Seeder;

class EnsembleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ensemble::create(['descr' => 'Elementary', 'abbr' => 'elem']);
        Ensemble::create(['descr' => 'Junior High', 'abbr' => 'jhs']);
    }
}
