<?php

namespace App\Http\Controllers;

use App\Models\Attendances;
use App\Models\Schedule;
use Illuminate\Http\Request;

class AttendancesController extends Controller
{
    public function index($id)
    {
        $schedule = Schedule::findOrFail($id);
        return view('pages.attendances.index', compact('schedule'));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendances $attendances)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendances $attendances)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendances $attendances)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendances $attendances)
    {
        //
    }
}
