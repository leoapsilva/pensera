<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('courses.index', ['courses' => Course::with('lectures')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        return Course::create($request->validated());

        //return redirect('/courses');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $Course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $Course)
    {
        return view('courses.show', [
            'course' => $Course::with('lectures')->findOrFail($Course->id),
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $Course
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request, Course $Course)
    {
        return $Course->update($request->validated());
        
        //return redirect('/courses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $Course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $Course)
    {
        $Course->delete();
        
        return redirect('/courses');
    }

}
