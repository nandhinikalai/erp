@extends('layouts.app')
@section('title', 'Courses List')
@section('main')
<div class="main-content">
   <section class="section">
      <div class="section-body"> 
          <div class="row">
              <div class="col-12">
                  <div class="card card-primary">
                     <form method="post" id="myForm" action="{{ route('courses.store') }}" enctype="multipart/form-data">
                        @csrf
                      <div class="card-body">
                      <div class="row">
                       <div class="form-group col-lg-3">
                        <label>Name</label>
                         <input type="text" name="title" placeholder="e.g Full Stack Web Development Batch 1" class="form-control form-control-sm" required>
                    </div>

                    <div class="form-group col-lg-3">
                        <label>Prerequisites</label>
                         <input type="text" name="prerequisites" placeholder="e.g html, css" class="form-control form-control-sm">
                    </div>

                    <div class="form-group col-lg-3">
                        <label>Category</label>
                         <input type="text" name="category" placeholder="e.g Web Development" class="form-control form-control-sm">
                    </div>

                 
                    <div class="form-group col-lg-3">
                        <label>Duration</label>
                        <input type="text" name="duration" placeholder="e.g 6 months" class="form-control form-control-sm" required>
                    </div>

            <div class="form-group col-lg-3">
            <label>Difficulty Level</label>
             <select name="level" class="form-control form-control-sm">
               <option value="">Select Level</option>
               <option value="Beginner">Beginner</option>
               <option value="Intermediate">Intermediate</option>
               <option value="Advanced">Advanced</option>
               <option value="Expert">Expert</option>
             </select>
          </div>

          <div class="form-group col-lg-3">
           <label>Enrollment Limit</label>
            <input type="number" name="enrollment_limit" placeholder="e.g 40" min="0" class="form-control form-control-sm" required>
          </div>

          <div class="form-group col-lg-3">
            <label>Start Time</label>
             <input type="time" name="start_time" placeholder="e.g 40"  class="form-control form-control-sm">
           </div>

           <div class="form-group col-lg-3">
            <label>End Time</label>
             <input type="time" name="end_time" placeholder="e.g 40"  class="form-control form-control-sm">
           </div>

          <div class="form-group col-lg-3">
              <label>Course Fee</label>
              <input type="number" name="course_fee"  min="0" placeholder="e.g 5000" class="form-control form-control-sm" required>
          </div>

          <div class="form-group col-lg-3">
               <label>Assessment Method</label>
              <input type="text" name="assessment_method" placeholder="e.g Midterm, Final" class="form-control form-control-sm">
          </div>

          <div class="form-group col-lg-3">
               <label>Enrollment Status</label>
               <select name="enrollment_status" class="form-control form-control-sm">
                <option value="">Select Option</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
          </div>

          <div class="form-group col-lg-3">
            <label>Concession</label>
            <select name="concession" class="form-control form-control-sm" required>
              <option value="">Select Option</option>
              <option value="Yes">Yes</option>
              <option value="No">No</option>
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