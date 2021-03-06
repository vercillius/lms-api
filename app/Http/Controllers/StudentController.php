<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();

        return response(['students' => $students]);
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

        ]);

        $student = new Student;
        $student->user_id = $request->user_id;
        $student->course = $request->course;
        $student->year = $request->year;
        $student->remarks = $request->remarks;
        $student->role_id = $request->role_id;
        $student->companyName = $request->companyName;
        $student->department = $request->department;
        $student->linkedin = $request->linkedin;
        $student->mobileNumber = $request->mobileNumber;
        $student->position = $request->position;
        $student->save();

        return response(['student' => $student]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);
        if($student){
            return response(['student' => $student]);
        }else{
            return response(['message' => 'Student not found'], 404);
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
            'user_id' => 'required|string',

        ]);

        $student = Student::find($id);
        if($student){
            $student->user_id = $request->user_id;
            $student->course = $request->course;
            $student->year = $request->year;
            $student->remarks = $request->remarks;
            $student->role_id = $request->role_id;
            $student->companyName = $request->companyName;
            $student->department = $request->department;
            $student->linkedin = $request->linkedin;
            $student->mobileNumber = $request->mobileNumber;
            $student->position = $request->position;
            $student->save();
            return response(['student' => $student]);
        }else{
            return response(['message' => 'Student not found'], 404);
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
        $student = Student::find($id);

        if($student){
            $student->delete();
            return response(['student' => $student]);
        }else{
            return response(['message' => 'Student not found'], 404);
        }
    }

    /**
     * Associate a school to a student
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function setSchool(Request $request, $id){

        $data = $request->validate([
            'school_id' => 'required|integer',
        ]);



        $school = School::find($request->school_id);
        $student = Student::find($id);

        $student->school()->associate($school);


        return response(['student' => $student]);


    }

    /**
     * Get school
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getSchool($id){


        $student = Student::find($id);
        if($student){
            return response(['schools' => $student->school]);
        }else{
            return response(['message' => 'Student not found'], 404);
        }


    }

    /**
     * Add course to a student
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function setCourse(Request $request, $id){

        $data = $request->validate([
            'course_id' => 'required|integer',
        ]);

        $student = Student::find($id);

        $student->courses()->attach($request->course_id);

        return response(['student' => $student]);
    }

    /**
     * Get all courses
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCourses($id){


        $student = Student::find($id);
        if($student){
            return response(['courses' => $student->courses]);
        }else{
            return response(['message' => 'Student not found'], 404);
        }


    }
     /**
     * Add task to a student
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function setTask(Request $request, $id){

        $data = $request->validate([
            'task_id' => 'required|integer',
        ]);

        $student = Student::find($id);

        $student->task()->attach($request->task_id);

        return response(['student' => $student]);
    }

    /**
     * Get all tasks
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getTasks($id){


        $student = Student::find($id);
        if($student){
            return response(['tasks' => $student->tasks]);
        }else{
            return response(['message' => 'Student not found'], 404);
        }


    }
}
