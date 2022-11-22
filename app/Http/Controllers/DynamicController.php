<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseDetail;
use App\Models\SemisterSession;
use Illuminate\Http\Request;

class DynamicController extends Controller
{
    public function index(){
        $sessions = SemisterSession::where('status','open')->get();
        $courses = Course::all();
        return view('web.pages.auth.dynamic',['sessions'=>$sessions,'courses'=>$courses]);
    }

    public function insertDynamic(Request $request){
        $category_name = $request->category_name;
        $category_value = $request->category_value;


        foreach(array_combine($category_name,$category_value) as $name => $value){
            $courseDetails = new CourseDetail();
            $courseDetails->session_id = $request->session_id;
            $courseDetails->course_id = $request->course_id;
            $courseDetails->category_name = $name;
            $courseDetails->category_value = $value;
            $courseDetails->save();
        }

        return response()->json([
            'course_details' => $courseDetails,
            'error' => false,
        ]);
    }

    public function index2(){
        $sessions = SemisterSession::where('status','open')->get();
        $courses = Course::all();
        return view('web.pages.auth.dynamic.dynamic',['sessions'=>$sessions,'courses'=>$courses]);
    }
}
