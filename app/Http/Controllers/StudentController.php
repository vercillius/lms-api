<?php

namespace App\Http\Controllers;

use App\Models\Student;
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
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|string',
            'course' => 'required|string',
            'year' => 'required|string',
            'password' => 'required|string',
            'remarks' => 'required|string',
        ]);

        $student = new Student;
        $student->firstName = $request->firstName;
        $student->lastName = $request->lastName;
        $student->email = $request->email;
        $student->course = $request->course;
        $student->year = $request->year;
        $student->password = Hash::make($request->password);
        $student->remarks = $request->remarks;
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
        $student = Student::find($id);
        if($student){
            $student->firstName = $request->firstName;
            $student->lastName = $request->lastName;
            $student->email = $request->email;
            $student->course = $request->course;
            $student->year = $request->year;
            $student->password = Hash::make($request->password);
            $student->remarks = $request->remarks;
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
}