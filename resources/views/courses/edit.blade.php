@extends('layouts.app')
@section('title', 'Courses List')
@section('main')
<div class="main-content">
   <section class="section">
      <div class="section-body"> 
          <div class="row">
              <div class="col-12">
                  <div class="card card-primary">
                     <form method="post" action="{{ route('courses.update', $course->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                      <div class="card-body">
                       
                      <div class="row">
                       
                       <div class="form-group col-lg-3">
                        <label>Name</label>
                         <input type="text" name="title" value="{{ $course->title }}" class="form-control form-control-sm" required>
          
                    </div>

                    <div class="form-group col-lg-3">
                        <label>Prerequisites</label>
                         <input type="text" name="prerequisites" value="{{ $course->prerequisites }}" class="form-control form-control-sm">
                    </div>

                    <div class="form-group col-lg-3">
                        <label>Category</label>
                         <input type="text" name="category" value="{{ $course->category }}" class="form-control form-control-sm">
                    </div>

                 
                    <div class="form-group col-lg-3">
                        <label>Duration</label>
                         <input type="text" name="duration" value="{{ $course->duration }}" class="form-control form-control-sm" required>
                    </div>

            <div class="form-group col-lg-3">
            <label>Difficulty Level</label>
             <select name="level" class="form-control form-control-sm">
               <option value="">Select Level</option>
               <option value="Beginner" @if($course->level == 'Beginner') selected @endif>Beginner</option>
               <option value="Intermediate" @if($course->level == 'Intermediate') selected @endif>Intermediate</option>
               <option value="Advanced" @if($course->level == 'Advanced') selected @endif>Advanced</option>
               <option value="Expert" @if($course->level == 'Expert') selected @endif>Expert</option>
             </select>
             
          </div>


          <div class="form-group col-lg-3">
            <label>Start Time</label>
             <input type="time" name="start_time" value="{{ $course->start_time }}" placeholder="e.g 40"  class="form-control form-control-sm">
           </div>

           <div class="form-group col-lg-3">
            <label>End Time</label>
             <input type="time" name="end_time" value="{{ $course->end_time }}" placeholder="e.g 40"  class="form-control form-control-sm">
           </div>

          <div class="form-group col-lg-3">
           <label>Enrollment Limit</label>
            <input type="number" value="{{ $course->enrollment_limit }}" name="enrollment_limit" min="0" class="form-control form-control-sm">
          </div>

          <div class="form-group col-lg-3">
              <label>Course Fee</label>
              <input type="number" value="{{ $course->course_fee }}" min="1" name="course_fee" class="form-control form-control-sm" required>
          </div>

          <div class="form-group col-lg-3">
               <label>Assessment Method</label>
              <input type="text" value="{{ $course->assessment_method }}" name="assessment_method" class="form-control form-control-sm">
          </div>

          <div class="form-group col-lg-3">
               <label>Enrollment Status</label>
               <select name="enrollment_status" class="form-control form-control-sm">
                <option value="">Select Option</option>
                <option value="Yes" @if($course->enrollment_status == 'Yes') selected @endif>Yes</option>
                <option value="No" @if($course->enrollment_status == 'No') selected @endif>No</option>
              </select>
          </div>

          <div class="form-group col-lg-3">
            <label>Concession</label>
            <select name="concession" class="form-control form-control-sm" required>
              <option value="">Select Option</option>
              <option value="Yes" @if($course->concession == 'Yes') selected @endif>Yes</option>
              <option value="No" @if($course->concession == 'No') selected @endif>No</option>
            </select>
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