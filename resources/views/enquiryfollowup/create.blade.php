@extends('layouts.app')
@section('title', 'Enquiry List')
@section('main')
<div class="main-content" x-data="app">
   <section class="section">
      <div class="section-body"> 
          <div class="row">
              <div class="col-12">
                  <div class="card card-primary">
                     <form method="get" id="myForm" action="{{ route('enquiry_followup.create') }}">
                        @csrf
                      <div class="card-body">
    
                      <div class="row">
                        <div class="form-group col-lg-3">
                           <label>Serach By</label>
                           <select name="serach" x-model="serach"  class="form-control form-control-sm" required>
                            <option value="">Select By</option>
                            <option value="id">Enquiry No</option>
                            <option value="mobile_no">Mobile No</option>
                          </select>
                       </div>

                       <datalist id="options">
                        <template x-for="row in options">
                          <option :value="row" x-text="row"></option>
                      </template>
                       </datalist>

                      
                       <div class="form-group col-lg-3">
                        <label>value</label>
                        <input type="text" name="value" list="options" x-model="value" x-on:keyup="serachBy()" class="form-control form-control-sm" required>
                      </div>

                      <div class="form-group col-lg-2">
                        <button type="submit" class="btn btn-primary m-t-25">Get</button>
                      </div>

                      </div>
                     
          </div>
                     </form>
      </div>
              </div>


         
              @if($enquiry)
              <div class="col-12">
                <div class="card card-primary">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-6">
                        <p>Enquiry No: {{ $enquiry->id }} </p>
                        <p>Student Name: {{ $enquiry->name }}</p>
                        <p>Mobile No: <b>{{ $enquiry->mobile_no }}</b></p>
                        <p>Total Follow Up: {{ $enquiry->followup()->count() }}</p>
                      </div>

                      <div class="col-6">
                        <p>DOB: {{ $enquiry->dob }}</p>
                        <p>Gender: {{ $enquiry->gender }}</p>
                        <p>Interested course: {{ $enquiry->course()->first()->title }}</p>
                        <p>Next Follow Up Date: {{ $enquiry->followup()->orderBy('id', 'desc')->first()->followup_date ?? '' }}</p>
                      </div>
                      
                    <div class="col-12">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Follow Up</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">History</a>
                      </li>
                     
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                      <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <form method="post" id="myForm" action="{{ route('enquiry_followup.store') }}" enctype="multipart/form-data">
                          @csrf

                        <div class="form-row">

                          <div class="form-group col-lg-4">
                            <input type="hidden" name="enquiry_id" value="{{ $enquiry->id }}">
                            <label>Follow Up Status</label>
                            <select name="status" class="form-control form-control-sm" required>
                             <option value="">Select Status</option>
                             <option value="Interested">Interested</option>
                             <option value="Not Interested">Not Interested</option>
                           </select>
                        </div>
                       
                        <div class="form-group col-lg-4">
                         <label>Remarks</label>
                         <textarea name="remarks" class="form-control form-control-sm"  cols="30" rows="10" required></textarea>
                       </div>

                       <div class="form-group col-lg-4">
                        <label>Follow Up Date</label>
                        <input type="date" name="followup_date" value="{{ date('Y-m-d') }}" class="form-control form-control-sm" required>
                      </div>

                      <div class="form-group col-lg-3">
                        <label>Date</label>
                        <input type="date" name="follow_date" value="{{ date('Y-m-d') }}" class="form-control form-control-sm">
                      </div>


                      <div class="form-group col-lg-3">
                        <label>Time</label>
                        <input type="time" name="follow_time" value="{{ date('H:i') }}" class="form-control form-control-sm">
                      </div>

 
                       <div class="form-group col-lg-12">
                         <button type="submit" class="btn btn-primary">Submit</button>
                       </div>

                        </div>
                        </form>

                      </div>
                      <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="table-responsive">
                          <table class="table table-striped table-sm" id="myTable">
                          <thead>
                            <tr role="row">
                              <th>#</th>
                              <th>Enquiry No</th>
                              <th>Enquiry Status</th>
                              <th>Next Follow Up Date</th>
                              <th>Remarks</th>
                              <th>Follow Up Date</th>
                              <th>Follow Up Time</th>
                            </tr>
                      
                            </thead>
                      
                            <tbody>
                         
                            @foreach($enquiry->followup()->get() as $key => $followup)
                            <tr>
                              <td>{{ $key+1 }}</td>
                              <td>{{ $enquiry->id }}</td>
                              <td>{{ $followup->status }}</td>
                              <td>{{ $followup->followup_date }}</td>
                              <td>{{ $followup->remarks }}</td>
                              <td>{{ $followup->follow_date }}</td>
                              <td>{{ $followup->follow_time }}</td>
                            </tr>
                            @endforeach
                          </tbody>
                          </table>
                      </div>
                      </div>
                     
                    </div>

                  </div>
                </div>
              </div>
              </div>
              </div>
              @endif
         



          </div>
      </div>
  
     </section>
</div>
@endsection

@section('js')
<script>
  document.addEventListener('alpine:init', () => {
  Alpine.data('app', () => ({
    serach:null,
    value:null,
    options : [],
    serachBy(){
     if(this.serach == 'id' || this.value.length < 3) 
      return false
      var mobile_no = @json(\App\Models\Enquiry::pluck('mobile_no'));
      this.options = mobile_no.filter((row) => {
        return row.toLowerCase().includes(this.value.toLowerCase())
      })
    },
  }))
 })
</script>
@endsection