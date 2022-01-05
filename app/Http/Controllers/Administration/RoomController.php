<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Event $event)
    {
        return view('administration.events.rooms.index',
            [
                'event' => $event,
                'rooms' => Room::all(),
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function create(Event $event)
    {
        return view('administration.events.rooms.create',
        [
            'event' => $event,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Event $event)
    {
        $input = $request->validate([
            'name' => ['required', 'string','unique:rooms,name'],
        ]);

        Room::create([
            'name' => $input['name']
        ]);

        return $this->index($event);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * @param  \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        if(isset($request['rooms'])){

            $input = $request->validate([
                'rooms' => ['nullable', 'array'],
                'rooms.*' => ['required', 'numeric'],
            ]);

            $event->rooms()->sync($input['rooms']);

        }else {

            $event->rooms()->detach();
        }

        return view('administration.events.index', ['events' => Event::all()]);
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
