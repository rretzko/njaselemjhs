<?php

namespace App\Http\Controllers\Administration\Reports;

use App\Http\Controllers\Controller;
use App\Models\Ensemble;
use App\Models\Event;
use App\Models\Utilities\FinalScore;
use Barryvdh\DomPDF\Facade AS PDF;

class PdfscoresController extends Controller
{
    public function index()
    {
        return view('administration.reports.scores.index',
        [
           'events' => Event::orderByDesc('id')->get(),
           'ensembles' => Ensemble::all(),
        ]);
    }

    public function download(Event $event, Ensemble $ensemble)
    {
        $filename = 'scores_'.str_replace(' ','_',$ensemble->name).'_'.date('Ymd_Gis',strtotime('NOW')).'.pdf';

        $finalscores = FinalScore::with('student')
            ->where('event_id', $event->id)
            ->where('ensemble_id', $ensemble->id)
            ->orderBy('voicepart_id')
            ->orderBy('score')
            ->get();

        $pdf = PDF::loadView('administration.reports.scores.pdf',
            compact('ensemble', 'event', 'finalscores'))->setPaper('letter','portrait');

        return $pdf->download($filename);
    }
}
