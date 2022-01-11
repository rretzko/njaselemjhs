<?php

namespace App\Http\Controllers;

use App\Models\Utilities\FinalScore;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFinalScoreRequest;
use App\Http\Requests\UpdateFinalScoreRequest;

class FinalScoreController extends Controller
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
     * @param  \App\Http\Requests\StoreFinalScoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFinalScoreRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Utilities\FinalScore  $finalScore
     * @return \Illuminate\Http\Response
     */
    public function show(FinalScore $finalScore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Utilities\FinalScore  $finalScore
     * @return \Illuminate\Http\Response
     */
    public function edit(FinalScore $finalScore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFinalScoreRequest  $request
     * @param  \App\Models\Utilities\FinalScore  $finalScore
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFinalScoreRequest $request, FinalScore $finalScore)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Utilities\FinalScore  $finalScore
     * @return \Illuminate\Http\Response
     */
    public function destroy(FinalScore $finalScore)
    {
        //
    }
}
