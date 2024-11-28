<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Enquiry;
use App\Models\EnquiryFollowup;
use Illuminate\Support\Facades\DB;
use Session;
class EnquiryFollowupController extends Controller{

    public function index(Request $request){
      
    }

    public function create(Request $request){
    $enquiry=null;
    if($request->serach){
        $enquiry = Enquiry::where($request->serach, $request->value)->first();
    }
    
     return view('enquiryfollowup.create',compact('enquiry'));
    }

    public function store(Request $request){
        $enquiry = EnquiryFollowup::create($request->all());
        return to_route('enquiry_followup.create');
    }

    public function edit(Request $request, EnquiryFollowup $enquiryfollowup){
     
    }

    public function update(Request $request, EnquiryFollowup $enquiryfollowup){
      
    }

    public function destroy(Request $request, EnquiryFollowup $enquiryfollowup){
        $enquiry->delete();
        return to_route('enquiry.index');
    }
}
