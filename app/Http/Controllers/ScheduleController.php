<?php

namespace App\Http\Controllers;

use App\Models\Qr;
use App\Models\Schedule;
use App\Models\User;
use App\Models\ClassEducation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ScheduleController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $date = Carbon::parse($now)->locale('id');
        $date->settings(['formatFunction' => 'translatedFormat']);
        $dayNow = $date->format('l');
        $schedules = Schedule::all();
        return view('pages.schedule.index', compact('schedules', 'dayNow'));
    }

    public function create()
    {
        $classEducations = ClassEducation::all();
        $users = User::all();
        return view('pages.schedule.create', compact('classEducations', 'users'));
    }

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

    public function show(Schedule $schedule)
    {
        //
    }

    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        $classEducations = ClassEducation::all();
        $users = User::all();
        return view('pages.schedule.edit', compact('schedule', 'classEducations', 'users'));
    }

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

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();
        return redirect()->route('schedule.index');
    }

    public function qr($id)
    {
        $unique = Str::uuid();
        Qr::create([
            'user_id' => $id,
            'code' => $unique,
        ]);
        return response()->streamDownload(
            function () use ($unique) {
                echo QrCode::size(200)
                    ->format('png')
                    ->generate($unique);
            },
            'qr-code.png',
            [
                'Content-Type' => 'image/png',
            ]
        );
    }
}