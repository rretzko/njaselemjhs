<?php

namespace App\Http\Controllers\Administration\Reports;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Student;
use Barryvdh\DomPDF\Facade as PDF;

class AdjudicationbackupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $event = Event::currentEvent()->first();

        $students = Student::where('event_id', $event->id)
            ->orderBy('ensemble_id')
            ->orderBy('last')
            ->get();

        $pdf = PDF::loadView('pdfs.adjudicationbackup',
            compact('students'))
            ->setPaper('letter','portrait');

        return $pdf->download('adjudicationbackup.pdf');
    }
}
