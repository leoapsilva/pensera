<?php

namespace App\Http\Controllers;

use App\Http\Requests\LectureRequest;
use App\Models\Lecture;
use Illuminate\Http\Request;

class LectureController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Lectures.index', ['dashboard' => (new Lecture)->buildDashboard()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Lectures.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LectureRequest $request)
    {
        return Lecture::create($request->validated());

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lecture  $Lecture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if (Lecture::where('id', $id)->exists()) {
            $lecture = Lecture::find($id);
    
            $lecture->name = is_null($request->name) ? $lecture->name : $request->name;
            $lecture->description = is_null($request->description) ? $lecture->description : $request->description;
            $lecture->link = is_null($request->link) ? $lecture->link : $request->link;
            $lecture->course_id = is_null($request->course_id) ? $lecture->course_id : $request->course_id;
            $lecture->save();
    
            return response()->json([
              "message" =>"Lecture ". $id . "updated successfully"
            ], 200);
          } else {
            return response()->json([
              "message" => "Lecture ". $id . " not found"
            ], 404);
          }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lecture  $Lecture
     * @return \Illuminate\Http\Response
     */
/*     public function destroy(Lecture $Lecture)   
    {
        return $Lecture->delete();
    }
 */
    public function destroy($id) {

        if(Lecture::where('id', $id)->exists()) {
            $lecture = Lecture::find($id);
            $lecture->delete();
    
            return response()->json([
              "message" => "deleted"
            ], 202);
          } else {
            return response()->json([
              "message" => "Lecture " . $id . " not found"
            ], 404);
          }
    }
}
