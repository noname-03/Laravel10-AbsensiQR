<?php

namespace App\Http\Controllers;

use App\Models\Attendances;
use App\Models\Qr;
use App\Models\Schedule;
use App\Models\User;
use App\Models\ClassEducation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Auth;

class ScheduleController extends Controller
{
    // construct
    public function __construct()
    {
        // middleware only qr role teacher
        $this->middleware(['role:admin'], ['only' => ['create', 'edit', 'update', 'destroy']]); //yang bisa ini cuma admin
    }

    public function index()
    {
        $now = Carbon::now();
        $date = Carbon::parse($now)->locale('id');
        $date->settings(['formatFunction' => 'translatedFormat']);
        $dayNow = $date->format('l');
        if (Auth::user()->hasRole('admin')) {
            $schedules = Schedule::all();
        } else {
            $user = Auth::user()->id;
            $schedules = Schedule::where('user_id', $user)->get();
        }
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

    public function qr($id, $user) //generate qr
    {
        $unique = Str::uuid();
        Qr::create([
            'schedule_id' => $id,
            'user_id' => $user,
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

    public function scanqr()
    {
        return view('pages.schedule.scan');
    }

    public function checkqr(Request $request)
    {
        $qr = Qr::where('code', $request->code)->first();
        if ($qr) {
            if ($request->status == 'hadir') {
                $imageName = null;
            } else {
                if ($request->file === 'undefined') {
                    return response()->json([
                        'status' => 404,
                        'message' => 'File Harus diisi'
                    ]);
                }
                $imageName = time() . '.' . $request->file->extension();
                $request->file->move(public_path('file'), $imageName);
            }
            Attendances::create([
                'schedule_id' => $qr->schedule_id,
                'status' => $request->status,
                'file' => $imageName,
                'note' => $request->note,
            ]);
            $qr->delete();
            return response()->json([
                'status' => 200
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'QR Code Tidak Di Temukan'
            ]);
        }
    }
}