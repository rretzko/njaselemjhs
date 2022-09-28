<?php

namespace App\Http\Controllers\Administration;

use App\Exports\DirectorsExport;
use App\Http\Controllers\Controller;
use App\Models\Director;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportDirectorsController extends Controller
{
    public function export()
    {
        $directors = new DirectorsExport(
            Director::orderBy('last')
                ->orderBy('first')
                ->get()
        );

        $datetime = date('Ynd_Gis');

        return Excel::download($directors, 'directors_'.$datetime.'.csv');

    }
}
