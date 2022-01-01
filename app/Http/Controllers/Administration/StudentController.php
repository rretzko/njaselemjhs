<?php

namespace App\Http\Controllers\Administration;

use App\Models\Director;
use App\Models\Ensemble;
use App\Models\Student;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\StudentRequest;
use App\Models\Voicepart;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Director $director)
    {
        return view('administration/students/index',
            [
                'director' => $director,
                'students' => $director->students,
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
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('administration/students/edit',
            [
                'student' => $student,
                'ensembles' => Ensemble::orderBy('descr')->get(),
                'voiceparts' => Voicepart::orderBy('ensemble_id')->orderBy('order_by')->get(),
                ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StudentRequest  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, Student $student)
    {
        $student->update(
            [
                "first" => $request['first'],
                "last" => $request['last'],
                "grade" => $request['grade'],
                "ensemble_id" => $request['ensemble_id'],
                "voicepart_id" => $request['voicepart_id'],
                "guardian_first" => $request['guardian_first'],
                "guardian_last" => $request['guardian_last'],
                "guardian_email" => $request['guardian_email'],
                "guardian_phone1" => $request['guardian_phone1'],
                "guardian_phone2" => $request['guardian_phone2'],
                "contract" => $request['contract'],
            ]
        );

        return $this->index(Director::find($student->user_id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
