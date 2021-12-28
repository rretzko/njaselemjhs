<?php

namespace App\Http\Controllers;

use App\Models\Voicepart;
use App\Http\Requests\StoreVoicepartRequest;
use App\Http\Requests\UpdateVoicepartRequest;

class VoicepartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreVoicepartRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVoicepartRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Voicepart  $voicepart
     * @return \Illuminate\Http\Response
     */
    public function show(Voicepart $voicepart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Voicepart  $voicepart
     * @return \Illuminate\Http\Response
     */
    public function edit(Voicepart $voicepart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVoicepartRequest  $request
     * @param  \App\Models\Voicepart  $voicepart
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVoicepartRequest $request, Voicepart $voicepart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Voicepart  $voicepart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voicepart $voicepart)
    {
        //
    }
}
