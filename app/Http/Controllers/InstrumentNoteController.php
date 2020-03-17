<?php

namespace App\Http\Controllers;

use App\InstrumentNote;
use Illuminate\Http\Request;

class InstrumentNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware('auth');
     }

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
     * @param  \App\InstrumentNote  $instrumentNote
     * @return \Illuminate\Http\Response
     */
    public function show(InstrumentNote $instrumentNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InstrumentNote  $instrumentNote
     * @return \Illuminate\Http\Response
     */
    public function edit(InstrumentNote $instrumentNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InstrumentNote  $instrumentNote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InstrumentNote $instrumentNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InstrumentNote  $instrumentNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(InstrumentNote $instrumentNote)
    {
        //
    }
}
