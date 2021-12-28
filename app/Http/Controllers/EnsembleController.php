<?php

namespace App\Http\Controllers;

use App\Models\Ensemble;
use App\Http\Requests\StoreEnsembleRequest;
use App\Http\Requests\UpdateEnsembleRequest;

class EnsembleController extends Controller
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
     * @param  \App\Http\Requests\StoreEnsembleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEnsembleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ensemble  $ensemble
     * @return \Illuminate\Http\Response
     */
    public function show(Ensemble $ensemble)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ensemble  $ensemble
     * @return \Illuminate\Http\Response
     */
    public function edit(Ensemble $ensemble)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEnsembleRequest  $request
     * @param  \App\Models\Ensemble  $ensemble
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEnsembleRequest $request, Ensemble $ensemble)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ensemble  $ensemble
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ensemble $ensemble)
    {
        //
    }
}
