<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    function index(){
        return view('course');
    }
    function findCourse($id){
        return view('checkcourse', ['id'=>$id]);
    }
}
