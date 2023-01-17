<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DirectorEventSeeder extends Seeder
{
    private $seeds;

    public function __construct()
    {
        $this->buildSeeds();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->seeds AS $seed){

            DB::table('director_event')
                ->insert(
                    [
                        'user_id' => $seed[0],
                        'event_id' => $seed[1],
                    ]
                );
        }
    }

    private function buildSeeds()
    {
        $this->seeds = [
            [2,2],
            [3,2],
            [4,2],
            [5,2],
            [6,2],
            [8,2],
            [9,2],
            [10,2],
            [11,2],
            [12,2],
            [13,2],
            [14,2],
            [15,2],
            [16,2],
            [17,2],
            [18,2],
            [19,2],
            [20,2],
            [21,2],
            [22,2],
            [23,2],
            [24,2],
            [25,2],
            [26,2],
            [27,2],
            [28,2],
            [29,2],
            [30,2],
            [31,2],
            [32,2],
            [33,2],
            [34,2],
            [35,2],
            [36,2],
            [37,2],
            [38,2],
            [39,2],
            [40,2],
            [41,2],
            [42,2],
            [43,2],
            [44,2],
            [45,2],
            [46,2],
            [47,2],
            [48,2],
            [49,2],
            [50,2],
            [51,2],
            [52,2],
            [53,2],
            [56,2],
            [58,2],
            ];
    }
}
