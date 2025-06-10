<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\classRoom;
class classroomController extends Controller
{
    public function create()
{
    $classrooms = classRoom::all();
    return view('user.StudentFillBiodata', compact('classrooms'));
}
}
