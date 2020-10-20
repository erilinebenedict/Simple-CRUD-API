<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Requests\studentRequest;
use App\Http\Requests\studentUpdateFormRequest;

class studentController extends Controller
{
    public function createStudent(studentRequest $request){
        $data = (object) $request;
        $student = Student::createStudent([
            "firstname" =>$data->firstname,
            "middlename" =>$data->middlename,
            "lastname" =>$data->lastname
        ]);

        if (!$student){
            return[
                "status" => 409,
                "message" => "Login credentials error",
            ];
        }

        return response([
            "status" => 200,
            "message" => "Student login success"
        ]);
    }

    public function studentRegistration(studentRequest $request){

        $student = new Student();
        $student->firstname = $request->input('firstname');
        $student->middlename = $request->input('middlename');
        $student->lastname = $request->input('lastname');
        $student->save();

        if (!$student){
            return response()->json([
                "status" => 422,
                "message" => "Invalid data supplied",
            ]);
        }

        return response([
            "status" => 200,
            "message" => "Student succeessfully registered !!"
        ]);
    }

    public function listRegisteredStudent(){
        // return Student::all();
        $students = Student::orderBy("created_at","ASC")->paginate(10);
        return response($students, 200);
    }

    public function getSingleRegisteredStudent($id){

        // if (Student::where("id", $id)->exist()){
        //     // $student = Student::find($id);
        //     $student = Student:: where("id", $id);
        //     if(!$student){
        //         return [
        //             "status" =>404,
        //             "message" => "Student not found"
        //         ];
        //     }
        //     return $student;
        // }

        $student = Student::find($id);
        return $student;
    }

    public function updateRegisteredStudent(studentUpdateFormRequest $updateFormRequest,$id){

        $data = (object) $updateFormRequest;

        $student = Student:: where("id",$id)->first();
        if(!$student){
            return [
                "status" => 404,
                "message" => "Student not found!!"
            ];
        }

        $student->update([
            "firstname" =>$data->firstname,
            "middlename" =>$data->middlename,
            "lastname" =>$data->lastname
        ]);

        return response()->json([
            "status" => 200,
            "message" => "Student updated succeessfully!!"
        ]);
    }
}  
