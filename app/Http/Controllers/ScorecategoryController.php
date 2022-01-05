<?php

namespace App\Http\Controllers;

use App\Models\Scorecategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreScorecategoryRequest;
use App\Http\Requests\UpdateScorecategoryRequest;

class ScorecategoryController extends Controller
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
     * @param  \App\Http\Requests\StoreScorecategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreScorecategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Scorecategory  $scorecategory
     * @return \Illuminate\Http\Response
     */
    public function show(Scorecategory $scorecategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Scorecategory  $scorecategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Scorecategory $scorecategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateScorecategoryRequest  $request
     * @param  \App\Models\Scorecategory  $scorecategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateScorecategoryRequest $request, Scorecategory $scorecategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Scorecategory  $scorecategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Scorecategory $scorecategory)
    {
        //
    }
}
