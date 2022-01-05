<?php

namespace App\Http\Controllers\Adjudication;

use App\Http\Controllers\Controller;
use App\Models\Adjudicator;
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
        $adjudicator = Adjudicator::where('user_id', auth()->id())->first();

        return view('adjudicators.index',
            [
                'adjudicator' => $adjudicator,
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
    public function show(Request $request, Adjudicator $adjudicator, Student $student)
    {
        return view('adjudicators.show',
            [
                'adjudicator' => $adjudicator,
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
     * @param  \App\Models\Student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        dd($request);
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
