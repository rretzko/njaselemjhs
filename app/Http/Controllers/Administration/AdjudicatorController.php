<?php

namespace App\Http\Controllers\Administration;

use App\Models\Adjudicator;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdjudicatorRequest;
use App\Http\Requests\UpdateAdjudicatorRequest;
use App\Models\Ensemble;
use App\Models\Event;
use App\Models\Room;
use App\Models\Utilities\Tables\AdjudicatorsTable;
use App\Models\Voicepart;

class AdjudicatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function index(Event $event)
    {
        $table = new AdjudicatorsTable(['event' => $event]);

        return view('administration.adjudicators.index',
            [
                'directors' => $event->getAdjudicatorCandidatesAttribute(),
                'adjudicators' => Adjudicator::all(),
                'ensembles' => Ensemble::all(),
                'event' => $event,
                'rooms' => Room::orderBy('name')->get(),
                'table' => $table->table,
                'voiceparts' => Voicepart::orderBy('descr')->get(),
            ]);
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
     * @param  \App\Http\Requests\StoreAdjudicatorRequest  $request
     * @param  \App\Models\Event $event
     * @param  \App\Models\Adjudicator $adjudicator
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdjudicatorRequest $request, Event $event, Adjudicator $adjudicator)
    {
        foreach($request['directors'] AS $userid){

            foreach($request['voiceparts'] AS $voicepartid){

                $adjudicator = Adjudicator::firstOrCreate([
                    'user_id' => $userid,
                    'event_id' => $event->id,
                    'ensemble_id' => $request['ensemble_id'],
                    'room_id' => $request['room_id'],
                    'voicepart_id' => $voicepartid,
                ]);
            }

        }

        return $this->index($event);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Adjudicator  $adjudicator
     * @return \Illuminate\Http\Response
     */
    public function show(Adjudicator $adjudicator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Adjudicator  $adjudicator
     * @return \Illuminate\Http\Response
     */
    public function edit(Adjudicator $adjudicator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdjudicatorRequest  $request
     * @param  \App\Models\Adjudicator  $adjudicator
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdjudicatorRequest $request, Adjudicator $adjudicator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Adjudicator  $adjudicator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Adjudicator $adjudicator)
    {
        //
    }
}
