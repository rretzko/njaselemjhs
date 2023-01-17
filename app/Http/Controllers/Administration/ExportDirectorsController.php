<?php

namespace App\Http\Controllers\Administration;

use App\Exports\DirectorsExport;
use App\Http\Controllers\Controller;
use App\Models\Director;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ExportDirectorsController extends Controller
{
    public function export()
    {
        $ids = DB::table('director_event')
            ->where('event_id', Event::currentEvent()->first()->id)
            ->pluck('user_id');

        $eventDirectors = Director::find($ids)->sortBy('last');

        $directors = new DirectorsExport($eventDirectors);

        $datetime = date('Ynd_Gis');

        return Excel::download($directors, 'directors_'.$datetime.'.csv');

    }
}
