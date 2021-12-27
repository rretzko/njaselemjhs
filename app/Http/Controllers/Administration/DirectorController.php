<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Models\Director;
use App\Http\Requests\StoreDirectorRequest;
use App\Http\Requests\UpdateDirectorRequest;

class DirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administration.directors.index', ['directors' => Director::orderBy('last')
            ->orderBy('first')
            ->get()]);
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
     * @param  \App\Http\Requests\StoreDirectorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDirectorRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Director  $director
     * @return \Illuminate\Http\Response
     */
    public function show(Director $director)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Director  $director
     * @return \Illuminate\Http\Response
     */
    public function edit(Director $director)
    {
        return view('administration.directors.edit', ['director' => $director]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDirectorRequest  $request
     * @param  \App\Models\Director  $director
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDirectorRequest $request, Director $director)
    {
        $director->update([
            'first' => $request['first'],
            'last' => $request['last'],
            //'email' => $request['email'],
            'phone' => $request['phone'],
            'address1' => $request['address1'],
            'address2' => $request['address2'] ?? '',
            'city' => $request['city'],
            'state_abbr' => $request['state_abbr'],
            'postal_code' => $request['postal_code'],
            'country' => $request['country'],
            'school' => $request['school'],
            'saddress1' => $request['address1'],
            'saddress2' => $request['address2'] ?? '',
            'scity' => $request['city'],
            'sstate_abbr' => $request['state_abbr'],
            'spostal_code' => $request['postal_code'],
            'membership' => $request['membership'],
            'elem_student_count' => $request['elem_student_count'] ?? 0,
            'jhs_student_count' => $request['jhs_student_count'] ?? 0,
        ]);

        $director->user->update(
            [
                'email' => $request['email'],
            ]
        );

        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Director  $director
     * @return \Illuminate\Http\Response
     */
    public function destroy(Director $director)
    {
        //
    }
}
