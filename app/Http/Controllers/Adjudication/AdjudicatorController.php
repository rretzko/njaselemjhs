<?php

namespace App\Http\Controllers\Adjudication;

use App\Http\Controllers\Controller;
use App\Models\Adjudicator;
use App\Models\Room;
use App\Models\Score;
use App\Models\Student;
use Illuminate\Http\Request;

class AdjudicatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('adjudicators.index',
            [
                'adjudicator' => Adjudicator::where('user_id', auth()->id())->first(),
            ]
        );
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
     * @param  \App\Models\Adjudicator $adjudicator
     * @param  \App\Models\Student $student
     * @return \Illuminate\Http\Response
     */
    public function show(Adjudicator $adjudicator, Student $student)
    {
        return view('adjudicators.show',
            [
                'adjudicator' => $adjudicator,
                'adjudicators' => Room::find($adjudicator->room_id)->adjudicators,
                'adjudicatorscores' => Score::where('student_id', $student->id)
                    ->where('adjudicator_id', $adjudicator->id)
                    ->get(),
                'student' => $student,
            ]);
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
     * @param  \App\Models\Adjudicator $adjudicator
     * @param  \App\Models\Student $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Adjudicator $adjudicator, Student $student)
    {
        $input = $request->validate([
            'scores' => ['required','array', 'min:5','max:5'],
            'scores.*' => ['required','numeric','min:1', 'max:9'],
        ]);

        foreach($input['scores'] AS $key => $score){
            Score::updateOrCreate(
                [
                    'student_id' => $student->id,
                    'adjudicator_id' => $adjudicator->id,
                    'ensemble_id' => $adjudicator->ensemble_id,
                    'scoredefinition_id' => ($key + 1),
                ],
                [
                    'score' => $score,
                ],
            );
        }

        return $this->show($adjudicator,$student);
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
