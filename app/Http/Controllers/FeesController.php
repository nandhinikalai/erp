<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Admission;
use App\Models\Fees;
use App\Models\Course;
use App\Models\Enquiry;
use Session;
class FeesController extends Controller{

    public function index(Request $request){
    }

    public function create(Request $request){
    $admission=null;
    $course_fee = 0;
    $courses = Course::all();
    $names = Admission::with('course')->get();
    if($request->has('mobile_no')){
        $admission = Admission::orWhere('mobile_no',$request->mobile_no)->orWhere('course_id',$request->course)->orWhere('name',$request->name)->first();
        if($admission){
            $course_fee = $admission->remaining_fees();
        }
    }
     return view('fees.create',compact('admission','course_fee','courses','names'));
    }

    public function store(Request $request){
      $data = $request->all();
      if($request->has('concession_type') && $request->concession_type == "percentage"){
          $data['concession_per'] = $data['concession_amt'];
          $data['concession_amt'] = $data['concession_amt'] / 100 * $data['course_fee'];
      }   
      $fees = Fees::create($data);
      if($fees)
        return to_route('admission.index');
    }

    public function show(Request $request,$admission_id){
        $admission = Admission::find($admission_id);
        return view('fees.show',compact('admission'));
    }

    public function edit(Request $request, Fees $fees){
     
    }

    public function update(Request $request, Fees $fees){
      
    }

    public function destroy(Request $request, Fees $fees){
        $fees->delete();
        return to_route('admission.index');
    }
}
