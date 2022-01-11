<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Models\Cutoff;
use App\Models\Ensemble;
use App\Models\Event;
use App\Models\Score;
use App\Models\Utilities\Tables\ParticipantsTable;
use Illuminate\Http\Request;

class CutoffensembleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\Event $event
     * @param  \App\Models\Ensemble $ensemble
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event, Ensemble $ensemble)
    {
        $scores = [];

        foreach($ensemble->voiceparts AS $voicepart){
            $scores[] = $voicepart->results($event, $ensemble);
        }

        $cutoff = new Cutoff;
        $table = new ParticipantsTable(['event' => $event, 'ensemble' => $ensemble]);

        return view('administration.cutoffs.ensembles.show',
            [
                'cutoffs' => $cutoff->cutoffs($event, $ensemble),
                'event' => $event,
                'ensemble' => $ensemble,
                'scores' => $scores,
                'table' => $table->table(),
            ]
        );
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
