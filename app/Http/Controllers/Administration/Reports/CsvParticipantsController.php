<?php

namespace App\Http\Controllers\Administration\Reports;

use App\Exports\ParticipantsExport;
use App\Http\Controllers\Controller;
use App\Models\Ensemble;
use App\Models\Event;
use App\Models\Participant;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CsvParticipantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administration.reports.participants.index',
            [
                'events' => Event::orderByDesc('id')->get(),
                'ensembles' => Ensemble::all(),
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Ensemble $ensemble
     * @param  \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function download(Event $event, Ensemble $ensemble)
    {
        $participants = new ParticipantsExport($event, $ensemble);

        $datetime = date('Ynd_Gis');

        return Excel::download($participants, 'participants_'.$datetime.'.csv');
        /*$participants = Participant::where('event_id', $event->id)
            ->where('ensemble_id', $ensemble->id)
            ->get();

        return Excel::download( new ParticipantsExport($participants),
            'participants_'.date('Ymd_Gia').'.csv');
        */
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
