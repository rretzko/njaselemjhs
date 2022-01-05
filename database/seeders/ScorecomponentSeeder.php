<?php

namespace Database\Seeders;

use App\Models\Scorecomponent;
use Illuminate\Database\Seeder;

class ScorecomponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Scorecomponent::create([
           'name' => 'Vocal Quality',
           'abbr' => 'VQ',
           'order_by' => 1,
        ]);

        Scorecomponent::create([
            'name' => 'Intonation',
            'abbr' => 'I',
            'order_by' => 2,
        ]);

        Scorecomponent::create([
            'name' => 'Musicianship',
            'abbr' => 'M',
            'order_by' => 3,
        ]);
    }
}
