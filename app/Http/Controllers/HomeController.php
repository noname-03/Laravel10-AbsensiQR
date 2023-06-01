<?php

namespace App\Http\Controllers;

use App\Models\ClassEducation;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use App\Models\Schedule;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->hasRole('admin')) {
            $schedules = Schedule::count();
        } else {
            $user = Auth::user()->id;
            $schedules = Schedule::where('user_id', $user)->count();
        }
        $user = User::count();
        $classEducation = ClassEducation::count();
        return view('home', compact('schedules', 'user', 'classEducation'));
    }
}