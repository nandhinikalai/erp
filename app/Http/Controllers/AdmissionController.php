<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Admission;
use App\Models\Enquiry;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
use Session;
class AdmissionController extends Controller{

    public function index(Request $request){
        $admissions = Admission::all();
        $data = DB::select('SELECT count(a.id)admission,b.title FROM `admission` a inner join courses b on a.course_id=b.id group by a.course_id');
        return view('admission.index',compact('admissions','data'));
    }

    public function create(Request $request){
        $courses = Course::all();
        $districts = DB::table('district_list')->get();
        $states = DB::table('district_list')->select('State')->distinct()->get();
        $health_issues = Enquiry::groupBy('health_issues')->get();
        $blood_group = Enquiry::groupBy('blood_group')->get();
        $document_type = Enquiry::groupBy('document_type')->get();
        $mobile_no = Enquiry::groupBy('mobile_no')->get();

        return view('admission.create',compact('courses','districts','states','health_issues','blood_group','document_type','mobile_no'));
    }

    public function store(Request $request){

        $request->validate([
            'mobile_no' => ['unique:admission,mobile_no','numeric'],
        ]);

        $data  = $request->except(['student_photo', 'documents', '_token', '_method']);
        if($request->hasFile('student_photo')){
            $student_photo = $request->file('student_photo')->store('admission', 'public');
            $data['student_photo'] = $student_photo;
        }
        if($request->hasFile('documents')){
            $documents = $request->file('documents')->store('admission/documents', 'public');
            $data['documents'] = $documents;
        }
        $enquiry = Admission::create($data);
        return to_route('admission.index');
    }

    function show(Request $request, Admission $admission){
        return view('fees.create',compact('admission'));
    }

    public function edit(Request $request, Enquiry $enquiry){
        // $courses = Course::all(); 
        // $districts = DB::table('district_list')->get();
        // $states = DB::table('district_list')->select('State')->distinct()->get();

        // $health_issues = Enquiry::groupBy('health_issues')->get();
        // $blood_group = Enquiry::groupBy('blood_group')->get();
        // $document_type = Enquiry::groupBy('document_type')->get();

        // return view('enquiry.edit',compact('enquiry','courses','districts','states','health_issues','blood_group','document_type'));
    }

    public function update(Request $request, Enquiry $enquiry){
        // $data  = $request->except(['student_photo', 'documents', '_token', '_method']);
        // if($request->hasFile('student_photo')){
        //     $student_photo = $request->file('student_photo')->store('enquiry', 'public');
        //     $data['student_photo'] = $student_photo;
        // }
        // if($request->hasFile('documents')){
        //     $documents = $request->file('documents')->store('enquiry/documents', 'public');
        //     $data['documents'] = $documents;
        // }
        // $enquiry->update($data);
        // return to_route('enquiry.index');
    }

    public function destroy(Request $request, Enquiry $enquiry){
        $enquiry->delete();
        return to_route('enquiry.index');
    }

    function enquiry(Request $request,$search,$value){
        $enquiry = Enquiry::where($search,$value)->first();
        if(!$enquiry)
         return response()->json(['message' => 'Enquiry not found!'], 404);
        return response()->json($enquiry, 200);
    }
}
