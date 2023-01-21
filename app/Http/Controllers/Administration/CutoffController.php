<?php

namespace App\Http\Controllers\Administration;

use App\Models\Cutoff;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCutoffRequest;
use App\Http\Requests\UpdateCutoffRequest;
use App\Models\Ensemble;
use App\Models\Event;
use App\Models\Participant;
use App\Models\Student;
use App\Models\Voicepart;

class CutoffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administration.cutoffs.index',['events' => Event::orderByDesc('id')->get()]);
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
     * @param  \App\Http\Requests\StoreCutoffRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCutoffRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('administration.cutoffs.show',
            [
                'event' => $event,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cutoff  $cutoff
     * @return \Illuminate\Http\Response
     */
    public function edit(Cutoff $cutoff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCutoffRequest  $request
     * @param  \App\Models\Cutoff  $cutoff
     * @return \Illuminate\Http\Response
     */
    public function update(Event $event, Ensemble $ensemble, Voicepart $voicepart, int $score)
    {
        Cutoff::updateOrCreate(
            [
                'event_id' => $event->id,
                'ensemble_id' => $ensemble->id,
                'voicepart_id' => $voicepart->id,
            ],
            [
                'score' => $score,
            ],
        );

        $participant = new Participant;

        $participant->updateParticipants($event, $ensemble, $voicepart);

        return redirect(route('administration.cutoffs.ensemble.show',
            [
                'event' => $event,
                'ensemble' => $ensemble,
                'cutoff' => $score,
            ])
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cutoff  $cutoff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cutoff $cutoff)
    {
        //
    }

    /**
     * Workaround to break-down in final-score preparation
     */
    public function finalScores()
    {
        $students = Student::where('event_id', Event::currentEvent()->first()->id)->get();

        foreach($students AS $student){

            $student->calcFinalScore();
        }

        $lastUpdate = 'Last Update: '.date('M d, Y g:i:s a').', '.$students->count().' students';
        session()->flash('finalScoreDate', $lastUpdate);

        return back();
    }
}
