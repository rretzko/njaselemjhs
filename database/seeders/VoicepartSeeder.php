<?php

namespace Database\Seeders;

use App\Models\Voicepart;
use Illuminate\Database\Seeder;

class VoicepartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Voicepart::create(['ensemble_id' => 1,'descr' => 'Treble I', 'abbr' => 'T1', 'order_by' => 1]);
        Voicepart::create(['ensemble_id' => 1,'descr' => 'Treble II', 'abbr' => 'T2', 'order_by' => 2]);
        Voicepart::create(['ensemble_id' => 1,'descr' => 'Treble III', 'abbr' => 'T3', 'order_by' => 3]);
        Voicepart::create(['ensemble_id' => 2,'descr' => 'Soprano I', 'abbr' => 'S1', 'order_by' => 1]);
        Voicepart::create(['ensemble_id' => 2,'descr' => 'Soprano II', 'abbr' => 'S2', 'order_by' => 2]);
        Voicepart::create(['ensemble_id' => 2,'descr' => 'Alto', 'abbr' => 'A1', 'order_by' => 3]);
        Voicepart::create(['ensemble_id' => 2,'descr' => 'Tenor', 'abbr' => 'T1', 'order_by' => 4]);
        Voicepart::create(['ensemble_id' => 2,'descr' => 'Bass I', 'abbr' => 'B1', 'order_by' => 5]);
        Voicepart::create(['ensemble_id' => 2,'descr' => 'Bass II', 'abbr' => 'B2', 'order_by' => 6]);
    }
}
