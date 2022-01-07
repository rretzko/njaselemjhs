<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Event::create([
            'name' => '2020 Elementary and Junior High School Honors Choir - 27th Annual',
            'short_name' => '2020 Elem & Jr HS Honors',
            'start_date' => '2019-02-01 00:00:00',
            'end_date' => '2021-01-20 23:59:59',
        ]);

        Event::create([
            'name' => '2021 Elementary and Junior High School Honors Choir - 28th Annual',
            'short_name' => '2021 Elem & Jr HS Honors',
            'start_date' => '2020-02-01 00:00:00',
            'end_date' => '2021-01-31 23:59:59',
        ]);

        Event::create([
            'name' => '2022 Elementary and Junior High School Honors Choir - 29th Annual',
            'short_name' => '2022 Elem & Jr HS Honors',
            'start_date' => '2021-02-01 00:00:00',
            'end_date' => '2022-01-31 23:59:59',
        ]);
    }
}
