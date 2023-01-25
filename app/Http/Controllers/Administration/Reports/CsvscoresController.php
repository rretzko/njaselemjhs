<?php

namespace App\Http\Controllers\Administration\Reports;

use App\Exports\ScoresExport;
use App\Http\Controllers\Controller;
use App\Models\Ensemble;
use App\Models\Event;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CsvscoresController extends Controller
{
    public function export(Event $event, Ensemble $ensemble)
    {
        $scores = new ScoresExport($event, $ensemble);

        $fileName = ucwords($ensemble->abbr).'_scores_'.date('Ynd_Gis').'.csv';

        return Excel::download($scores, $fileName);

    }
}
