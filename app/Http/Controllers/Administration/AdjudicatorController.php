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
                'ensemble' => new Ensemble,
                'ensembles' => Ensemble::all(),
                'event' => $event,
                'room' => new Room,
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
    public function create(Event $event)
    {
        $table = new AdjudicatorsTable(['event' => $event]);

        return view('administration.adjudicators.index',
            [
                'directors' => $event->getAdjudicatorCandidatesAttribute(),
                'adjudicators' => Adjudicator::all(),
                'ensemble' => new Ensemble,
                'ensembles' => Ensemble::all(),
                'event' => $event,
                'room' => new Room,
                'rooms' => Room::orderBy('name')->get(),
                'table' => $table->table,
                'voiceparts' => Voicepart::orderBy('descr')->get(),
            ]);
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

                Adjudicator::firstOrCreate([
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
     * @param  integer $event_id
     * @param  integer $ensemble_id
     * @param  integer $room_id
     * @return \Illuminate\Http\Response
     */
    public function edit($event_id, int $ensemble_id, int $room_id)
    {
        $event = Event::find($event_id);

        $table = new AdjudicatorsTable(['event' => $event]);

        return view('administration.adjudicators.edit',
            [
                'directors' => $event->getAdjudicatorCandidatesAttribute(),
                'adjudicators' => Adjudicator::all(),
                'ensemble' => Ensemble::find($ensemble_id),
                'ensembles' => Ensemble::all(),
                'event' => $event,
                'room' => Room::find($room_id),
                'rooms' => Room::orderBy('name')->get(),
                'table' => $table->table,
                'voiceparts' => Voicepart::orderBy('descr')->get(),
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdjudicatorRequest  $request
     * @param  \App\Models\Event $event
     * @param  \App\Models\Room $room
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdjudicatorRequest $request, Event $event, Room $room)
    {
        /*
         *  "directors" => array:3 [▼
        0 => "10"
        1 => "14"
        2 => "36"
        ]
        */

        $directors = $request['directors'];
        $adjudicators = $room->adjudicators;
        $ensembleid = $adjudicators[0]->ensemble_id;
        $voicepartid = $adjudicators[0]->voicepart_id;

        /* add new Directors */
        foreach($request['directors'] AS $user_id){

            Adjudicator::updateOrCreate(
                [
                    'user_id' => $user_id,
                    'event_id' => $event->id,
                    'ensemble_id' => $ensembleid,
                    'room_id' => $room->id,
                ],
                [
                    'voicepart_id' =>$voicepartid,
                ]
            );
        }

        //delete removed Adjudicators in $room for $event
        foreach($room->adjudicators AS $adjudicator){

            if(! in_array($adjudicator->user_id, $directors)){

                Adjudicator::destroy($adjudicator->id);
            }
        }

        return $this->index($event);
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
