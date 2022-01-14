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
            $scores[] = $voicepart->results($event, $ensemble)->sortBy('score');
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

}
