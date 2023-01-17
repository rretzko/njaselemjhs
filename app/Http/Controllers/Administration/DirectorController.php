<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Http\Requests\DirectorRequest;
use App\Models\Director;
use App\Http\Requests\StoreDirectorRequest;
use App\Http\Requests\UpdateDirectorRequest;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

class DirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentEvent = Event::currentEvent()->first();

        $ids = DB::table('director_event')
           ->select('user_id')
           ->where('event_id', $currentEvent->id)
           ->get()
           ->pluck('user_id');

        $directors = Director::find($ids)->sortBy('last');

        return view('administration.directors.index',
            [
                'event' => $currentEvent,
                'eventYear' => substr($currentEvent->name,0,4),
                'directors' => $directors,
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
     * @param \App\Http\Requests\StoreDirectorRequest $request
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
    public function update(DirectorRequest $request, Director $director)
    {
        $director->update([
            'first' => $request['first'],
            'last' => $request['last'],
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
            'judging_day' => is_null($request['judging_day']) ? 0 : 1,
            'rehearsal_day' => is_null($request['rehearsal_day']) ? 0 : 1,
            'festival_day' => is_null($request['festival_day']) ? 0 : 1,
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
