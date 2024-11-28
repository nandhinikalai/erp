@extends('layouts.app')
@section('title', 'Admission')
@section('main')
<div class="main-content">
   <section class="section">
      <div class="section-body"> 
          <div class="row">
              <div class="col-12">
                  <div class="card card-primary" x-data="app">
                     <form method="post" id="myForm"  action="{{ route('admission.store') }}" enctype="multipart/form-data">
                        @csrf
                      <div class="card-body">
    
                      <div class="row">

                        <div class="form-group col-lg-3">
                          <label>Enquiry No</label>
                           <input type="text" name="enquiry_no" x-model="enquiry.id" x-on:change="getEnquiry('id',enquiry.id)" class="form-control form-control-sm" />
                      </div>


                      <datalist id="options">
                        @foreach ($mobile_no as $row)
                        <option value="{{$row->mobile_no}}">{{$row->mobile_no}}</option>
                        @endforeach
                       </datalist>

                        <div class="form-group col-lg-3">
                           <label>Name</label>
                            <input type="text" name="name" x-model="enquiry.name" x-on:change="getEnquiry('name',enquiry.name)" class="form-control form-control-sm" required>
                       </div>
                      
                       <div class="form-group col-lg-3">
                        <label>Type</label>
                         <select name="type" x-model="enquiry.type" class="form-control form-control-sm" required>
                           <option value="">Select Type</option>
                           <option value="Outside Student">Outside Student</option>
                           <option value="Inside Student">Inside Student</option>
                         </select>
                      </div>

                      <div class="form-group col-lg-3">
                        <label>Date of Birth</label>
                         <input type="date" x-model="enquiry.dob" value="2003-01-01" name="dob" class="form-control form-control-sm" required>
                    </div>

                    <div class="form-group col-lg-3">
                      <label>Admission Date</label>
                       <input type="date" value="{{date('Y-m-d')}}" name="admission_date" class="form-control form-control-sm">
                  </div>

                    <div class="form-group col-lg-3">
                      <label>Gender</label>
                       <select name="gender" x-model="enquiry.gender" class="form-control form-control-sm" required>
                         <option value="">Select Gender</option>
                         <option value="Male">Male</option>
                         <option value="Female">Female</option>
                         <option value="Transgender">Transgender</option>
                       </select>
                
                    </div>

                    <div class="form-group col-lg-3">
                      <label>Mobile No</label>
                       <input type="text" x-model="enquiry.mobile_no" name="mobile_no" x-on:change="getEnquiry('mobile_no',enquiry.mobile_no)" list="options" maxlength="10" class="form-control form-control-sm @error('mobile_no') is-invalid @enderror">
                       @error('mobile_no')
                       <div class="invalid-feedback">{{ $message }}</div>
                       @enderror
                
                  </div>

                  <div class="form-group col-lg-3">
                    <label>Address Line1</label>
                     <input type="text" x-model="enquiry.address_line1" name="address_line1" class="form-control form-control-sm" required>
                </div>

                <div class="form-group col-lg-3">
                  <label>Address Line2</label>
                   <input type="text" x-model="enquiry.address_line2" name="address_line2" class="form-control form-control-sm" required>
              </div>

              
            <div class="form-group col-lg-3">
              <label>State</label>
               <select name="state" x-model="enquiry.state" id="state" required>
                 <option value="">Select State</option>
                 @foreach ($states as $state)
                 <option value="{{$state->State}}">{{$state->State}}</option>
                 @endforeach
               </select>
          </div>

              <div class="form-group col-lg-3">
                <label>District</label>
                 <select name="city" x-model="enquiry.city" id="city" required>
                   <option value="">Select District</option>
                   @foreach ($districts as $district)
                   <option value="{{$district->District}}">{{$district->District}}</option>
                   @endforeach
                 </select>
            </div>


            <div class="form-group col-lg-3">
              <label>Pincode</label>
               <input type="number" x-model="enquiry.pincode" name="pincode" class="form-control form-control-sm">
          </div>
        
                   
          <div class="form-group col-lg-12"><h6> Parents Details</h6> <hr style="border-bottom: 1px solid #ccc;"></div>

          <div class="form-group col-lg-12">
            <label>Relation Type</label>
             <div class="form-check form-check-inline">
               <input class="form-check-input" type="checkbox" value="Father" name="relation_type" id="relation_type_father" checked>
               <label class="form-check-label" for="relation_type_father">
                 Father
               </label>
               
             </div>
             <div class="form-check form-check-inline">
               <input class="form-check-input" type="checkbox" value="Mother" :checked="mother" x-model="mother" name="relation_type" id="relation_type_mother">
               <label class="form-check-label" for="relation_type_mother">
                 Mother
               </label>
             </div>

             <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" value="Guardian" :checked="guardian" x-model="guardian" name="relation_type" id="relation_type_guardian">
              <label class="form-check-label" for="relation_type_guardian">
                Guardian
              </label>
            </div>

          </div>

          <div class="form-group col-lg-3">
            <label>Father Name</label>
             <input type="text" name="father_name" x-model="enquiry.father_name" class="form-control form-control-sm" required>
        </div>

        <div class="form-group col-lg-3">
          <label>Father Mobile No</label>
           <input type="text" name="father_no" x-model="enquiry.father_no" class="form-control form-control-sm" required>
      </div>

      <div class="form-group col-lg-3">
        <label>Father Occupation</label>
         <input type="text" name="father_occupation" x-model="enquiry.father_occupation" class="form-control form-control-sm">
    </div>

    <div class="form-group col-lg-3">
      <label>Father Email </label>
       <input type="text" name="father_email" x-model="enquiry.father_email" class="form-control form-control-sm">
  </div>


  <div class="form-group col-lg-3" x-show="mother">
    <label>Mother Name</label>
     <input type="text" name="mother_name" x-model="enquiry.mother_name" class="form-control form-control-sm">
</div>

<div class="form-group col-lg-3" x-show="mother">
  <label>Mother Mobile No</label>
   <input type="text" name="mother_no" x-model="enquiry.mother_no" class="form-control form-control-sm">
</div>

<div class="form-group col-lg-3" x-show="mother">
<label>Mother Occupation</label>
 <input type="text" name="mother_occupation" x-model="enquiry.mother_occupation" class="form-control form-control-sm">
</div>

<div class="form-group col-lg-3" x-show="mother">
<label>Mother Email </label>
<input type="text" name="mother_email" x-model="enquiry.mother_email" class="form-control form-control-sm">
</div>




    <div class="form-group col-lg-3" x-show="guardian">
      <label>Guardian Name</label>
       <input type="text" name="guardian_name" x-model="enquiry.guardian_name" class="form-control form-control-sm">
  </div>
  
  <div class="form-group col-lg-3" x-show="guardian">
    <label>Guardian Mobile No</label>
     <input type="text" name="guardian_no" x-model="enquiry.guardian_no" class="form-control form-control-sm">
  </div>
  
  <div class="form-group col-lg-3" x-show="guardian">
  <label>Guardian Occupation</label>
   <input type="text" name="guardian_occupation" x-model="enquiry.guardian_occupation" class="form-control form-control-sm">
  </div>
  
  <div class="form-group col-lg-3" x-show="guardian">
  <label>Guardian Email </label>
  <input type="text" name="guardian_email" x-model="enquiry.guardian_email" class="form-control form-control-sm">
  </div>
 



    <div class="form-group col-lg-12"><h6>Additional  Details</h6> <hr style="border-bottom: 1px solid #ccc;"></div>

    <div class="form-group col-lg-3">
      <label>Refereed By</label>
      <select name="refereed_by" x-model="enquiry.refereed_by" class="form-control form-control-sm" required>
      <option value="">Select Refereed By</option>
      <option value="Advertisement">Advertisement</option>
      <option value="Email">Email</option>
      <option value="Phone">Phone</option>
      <option value="Campus walk-in">Campus walk-in</option>
      <option value="Website">Website</option>
      <option value="Pamplet">Pamplet</option>
      <option value="Events">Events</option>
      <option value="Others">Others</option>
    </select>
  </div>

  <div class="form-group col-lg-3">
    <label>Remarks</label>
     <textarea name="remarks" x-model="enquiry.remarks" class="form-control form-control-sm" cols="30" rows="5"></textarea>
  </div>

<div class="form-group col-lg-3">
  <label>Blood group</label>
   <select name="blood_group" x-model="enquiry.blood_group" id="blood_group">
    <option value="">Select Blood Group</option>
    @foreach ($blood_group as $row)
    <option value="{{$row->blood_group}}">{{$row->blood_group}}</option>
    @endforeach
  </select>
</div>

<div class="form-group col-lg-3" x-show="!enquiry.student_photo">
  <label>student photo</label>
   <input type="file"  name="student_photo" accept="image/*" class="form-control form-control-sm">
</div>


<div class="form-group col-lg-3" x-show="!enquiry.documents">
  <label>Document Type</label>
  <select name="document_type" x-model="enquiry.document_type" id="document_type">
    <option value="">Select Document Type</option>
    @foreach ($document_type as $row)
    <option value="{{$row->document_type}}">{{$row->document_type}}</option>
    @endforeach
  </select>
</div>

<div class="form-group col-lg-3" x-show="!enquiry.documents">
  <label>Documents</label>
   <input type="file" accept="image/*,application/pdf"  name="documents" class="form-control form-control-sm">
</div>

<div class="form-group col-lg-3">
  <label>Health Issues</label>
  <select name="health_issues" x-model="enquiry.health_issues" id="health_issues">
    <option value="">Select Health Issues</option>
    @foreach ($health_issues as $issue)
    <option value="{{$issue->health_issues}}">{{$issue->health_issues}}</option>
    @endforeach
  </select>
</div>

<div class="form-group col-lg-3">
  <label>Health Remarks</label>
   <textarea name="health_remarks" x-text="enquiry.health_remarks" class="form-control form-control-sm" cols="30" rows="5"></textarea>
</div>


<div class="form-group col-lg-12"><h6>Course  Details</h6> <hr style="border-bottom: 1px solid #ccc;"></div>

<div class="form-group col-lg-3">
  <label>course</label>
   <select name="course_id" x-model="course_id" x-on:change="getCourses()" class="form-control form-control-sm" required>
     <option value="">Select Course</option>
     @foreach ($courses as $course)
     <option value="{{$course->id}}">{{$course->title}}</option>
     @endforeach
   </select>
</div>


<div class="form-group col-lg-3">
  <label>Course Duration</label>
   <input type="text" :value="course.duration"  class="form-control form-control-sm" readonly>
</div>


<div class="form-group col-lg-3">
  <label>Course Fees</label>
   <input type="text" :value="course.course_fee" name="total_fee" class="form-control form-control-sm" readonly>
</div>
  
        <div class="form-group col-lg-12">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>

         
                      </div>
                     
          </div>
                     </form>
      </div>
              </div>
          </div>
      </div>
  
     </section>
</div>
@endsection

@section('js')
<script>
  const state = new TomSelect('#state', {});
  const city = new TomSelect('#city', {});
  const blood_group = new TomSelect('#blood_group', {create: true,});
  const document_type = new TomSelect('#document_type', {create: true,});
  const health_issues = new TomSelect('#health_issues', {create: true,});

  document.addEventListener('alpine:init', () => {
      Alpine.data('app', () => ({
        enquiry:{},
        mother:null,
        courses:@json($courses),
        course:{},
        course_id:null,
        guardian:null,
        getEnquiry(key,value){
          $.getJSON('{{url("admin/admission/enquiry")}}/'+key+'/'+value, (data) => {
            this.enquiry = data;
            this.mother = data.mother_name ? 1 : 0;
            this.guardian = data.guardian_name ? 1 : 0;
            state.setValue(data.state);
            city.setValue(data.city);
            blood_group.setValue(data.blood_group);
            document_type.setValue(data.document_type);
            health_issues.setValue(data.health_issues);
          });
        },
        getCourses(){
          this.course = this.courses.find((course) => course.id == this.course_id);
          console.log(this.course);
        },
      }))
  })
  
</script>
@endsection