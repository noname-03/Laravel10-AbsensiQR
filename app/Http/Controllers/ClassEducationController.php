<?php

namespace App\Http\Controllers;

use App\Models\ClassEducation;
use Illuminate\Http\Request;

class ClassEducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classEducations = ClassEducation::all();
        return view('pages.classEducation.index', compact('classEducations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.classEducation.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate
        $request->validate([
            'title' => 'required',
        ]);
        ClassEducation::create([
            'title' => $request->title,
        ]);
        return redirect()->route('classEducation.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $classEducation = ClassEducation::findOrFail($id);
        return view('pages.classEducation.edit', compact('classEducation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $classEducation = ClassEducation::findOrFail($id);
        $request->validate([
            'title' => 'required',
        ]);
        $classEducation->update([
            'title' => $request->title,
        ]);
        return redirect()->route('classEducation.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $classEducation = ClassEducation::findOrFail($id);
        $classEducation->delete();
        return redirect()->route('classEducation.index');
    }
}