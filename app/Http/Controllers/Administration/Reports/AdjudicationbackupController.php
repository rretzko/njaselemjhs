<?php

namespace App\Http\Controllers\Administration\Reports;

use App\Http\Controllers\Controller;
use App\Models\Ensemble;
use App\Models\Event;
use App\Models\Student;
use Barryvdh\DomPDF\Facade as PDF;

class AdjudicationbackupController extends Controller
{
    /**
     * Download pdf for use as paper backup if internet fails.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Ensemble $ensemble)
    {
        set_time_limit(120);

        $event = Event::currentEvent()->first();

        $students = Student::where('event_id', $event->id)
            ->where('ensemble_id', $ensemble->id)
            ->orderBy('last')
            ->get();

        $pdf = PDF::loadView('pdfs.adjudicationbackup',
            compact('students'))
            ->setPaper('letter','portrait');

        $fileName = 'adjudicationBackup_'.ucwords($ensemble->abbr).'_'.date('ynd_Gis').'.pdf';
        return $pdf->download($fileName);
    }
}
