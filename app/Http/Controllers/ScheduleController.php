<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\User;
use App\Models\ClassEducation;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Schedule::all();
        return view('pages.schedule.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classEducations = ClassEducation::all();
        $users = User::all();
        return view('pages.schedule.create', compact('classEducations', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_education_id' => 'required',
            'user_id' => 'required',
            'day' => 'required',
        ]);
        Schedule::create([
            'class_education_id' => $request->class_education_id,
            'user_id' => $request->user_id,
            'day' => $request->day,
        ]);
        return redirect()->route('schedule.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        $classEducations = ClassEducation::all();
        $users = User::all();
        return view('pages.schedule.edit', compact('schedule', 'classEducations', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'class_education_id' => 'required',
            'user_id' => 'required',
            'day' => 'required',
        ]);
        $schedule = Schedule::findOrFail($id);
        $schedule->update([
            'class_education_id' => $request->class_education_id,
            'user_id' => $request->user_id,
            'day' => $request->day,
        ]);
        return redirect()->route('schedule.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();
        return redirect()->route('schedule.index');
    }
}