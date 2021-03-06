<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faculty = Faculty::all();

        return response(['faculty' => $faculty]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|integer',
            'role_id' => 'required|integer'

        ]);

        $faculty = new Faculty;
        $faculty->user_id = $request->user_id;
        $faculty->course_id = $request->course_id;
        $faculty->role_id = $request->role_id;
        $faculty->save();

        return response(['faculty' => $faculty]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $faculty = Faculty::find($id);
        if($faculty){
            return response(['faculty' => $faculty]);
        }else{
            return response(['message' => 'Faculty not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $data = $request->validate([
            'user_id' => 'required|integer',
            'role_id' => 'required|integer'

        ]);

        $faculty = Faculty::find($id);
        if($faculty){
            $faculty->user_id = $request->user_id;
            $faculty->course_id = $request->course_id;
            $faculty->role_id = $request->role_id;
            $faculty->save();
            return response(['faculty' => $faculty]);
        }else{
            return response(['message' => 'Faculty not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faculty = Faculty::find($id);

        if($faculty){
            $faculty->delete();
            return response(['faculty' => $faculty]);
        }else{
            return response(['message' => 'Faculty not found'], 404);
        }
    }

    /**
     * Add a course to a faculty
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function setCourse(Request $request, $id){

        $data = $request->validate([
            'course_id' => 'required|integer',
        ]);

        $faculty = Faculty::find($id);

        $faculty->courses()->attach($request->course_id);

        return response(['faculty' => $faculty]);
    }

    /**
     * Get all courses
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCourses($id){


        $faculty = Faculty::find($id);
        if($faculty){
            return response(['courses' => $faculty->courses]);
        }else{
            return response(['message' => 'Faculty not found'], 404);
        }


    }

    /**
     * Add a school to a faculty
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function setSchool(Request $request, $id){

        $data = $request->validate([
            'school_id' => 'required|integer',
        ]);

        $faculty = Faculty::find($id);

        $faculty->schools()->attach($request->school_id);

        return response(['faculty' => $faculty]);
    }

    /**
     * Get all schools
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getSchools($id){


        $faculty = Faculty::find($id);
        if($faculty){
            return response(['schools' => $faculty->schools]);
        }else{
            return response(['message' => 'Faculty not found'], 404);
        }


    }
}
