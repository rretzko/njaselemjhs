<?php

namespace App\Http\Controllers;

use App\Models\Scorecomponent;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreScorecomponentRequest;
use App\Http\Requests\UpdateScorecomponentRequest;

class ScorecomponentController extends Controller
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
     * @param  \App\Http\Requests\StoreScorecomponentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreScorecomponentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Scorecomponent  $scorecomponent
     * @return \Illuminate\Http\Response
     */
    public function show(Scorecomponent $scorecomponent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Scorecomponent  $scorecomponent
     * @return \Illuminate\Http\Response
     */
    public function edit(Scorecomponent $scorecomponent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateScorecomponentRequest  $request
     * @param  \App\Models\Scorecomponent  $scorecomponent
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateScorecomponentRequest $request, Scorecomponent $scorecomponent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Scorecomponent  $scorecomponent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Scorecomponent $scorecomponent)
    {
        //
    }
}
