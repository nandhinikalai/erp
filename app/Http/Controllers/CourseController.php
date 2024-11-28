<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use Session;
class CourseController extends Controller{

    public function index(Request $request){
        $courses = Course::all(); 
        return view('courses.index',compact('courses'));
    }

    public function create(Request $request){
        return view('courses.create');
    }

    public function store(Request $request){
        $course = Course::create($request->all());
        return to_route('courses.index');
    }

    public function edit(Request $request, Course $course){
        return view('courses.edit',compact('course'));
    }

    public function update(Request $request, Course $course){
        $course->update($request->all());
        return to_route('courses.index');
      
    }

    public function destroy(Request $request, Course $course){
        $course->delete();
        return to_route('courses.index');
    }
}
