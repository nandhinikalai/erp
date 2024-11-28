@extends('layouts.app')
@section('title', 'Fees List')
@section('main')
<div class="main-content" x-data="app">
   <section class="section">
      <div class="section-body"> 
          <div class="row">
           
              <div class="col-md-12">
                <div class="card card-primary">
                  <div class="card-body">
                    <form action="{{ route('fees.create') }}" enctype="multipart/form-data">
                    <div class="row">
                      <div class="form-group col-lg-4">
                        <label>Name</label>
                         <select name="name"  x-on:change="getdata($el.value)" id="name">
                           <option value="">Select Name</option>
                         </select>
                      </div>

                      <div class="form-group col-lg-3">
                        <label>Mobile No</label>
                         <input type="text" name="mobile_no" x-model="mobile_no"  maxlength="10" class="form-control form-control-sm" required />
                      </div>

                      <div class="form-group col-lg-3">
                        <label>course</label>
                         <select name="course" x-model="course" class="form-control form-control-sm" required>
                           <option value="">Select Course</option>
                           @foreach ($courses as $course)
                           <option value="{{$course->id}}">{{$course->title}}</option>
                           @endforeach
                         </select>
                      </div>


                         <div class="form-group col-lg-2 mt-4">
          <button type="submit" class="btn btn-primary">Get</button>
        </div>
                   
                   
                    </div>
                    </form>
                  </div>
                  </div>
              </div>

                @if($admission)
                <div class="col-md-12">
                <div class="card card-primary">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-4 col-sm-12">
                        <p class="mb-1">Admission No: {{ $admission->id }} </p>
                        <p class="mb-1">Student Name: {{ $admission->name }}</p>
                        <p class="mb-1">Mobile No: <b>{{ $admission->mobile_no }}</b></p>
                      </div>

                      <div class="col-md-4 col-sm-12">
                        <p class="mb-1">DOB: {{ $admission->dob }}</p>
                        <p class="mb-1">Gender: {{ $admission->gender }}</p>
                        <p class="mb-1">Course: {{ $admission->course->title }}</p>
                      </div>

                      <div class="col-md-4 col-sm-12">
                        <p class="mb-1">Father Name: {{ $admission->father_name }}</p>
                        <p class="mb-1">Mother Name: {{ $admission->mother_name }}</p>
                        
                      </div>

                      <div class="col-md-6 col-sm-12 mb-2"><a href="{{ route('fees.show', $admission->id) }}" class="btn btn-primary">View Transactions</a></div> 
                    </div>
              
                    <form action="{{ route('fees.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="admission_id" value="{{ $admission->id }}">
                        <div class="row">
                           <div class="form-group col-md-3 col-sm-12">
                          <label>Payment Date</label>
                          <input type="date" name="payment_date" value="{{ date('Y-m-d') }}" class="form-control form-control-sm" required/>
                        </div> 
                        <div class="form-group col-md-3 col-sm-12">
                          <label>Fees Title</label>
                          <input type="text" name="title" value="tuition fees" class="form-control form-control-sm" placeholder="Enter Title"/>
                        </div>
                        <div class="form-group col-md-3 col-sm-12">
                          <label>Fees Amount</label>
                          <input type="number" name="amount" step="any" min="0" max="{{ $course_fee }}" value="{{ $course_fee }}" class="form-control form-control-sm" placeholder="Enter Amount" required/>
                        </div>
                        
                        <div class="form-group col-md-3 col-sm-12">
                          <label>Payment Method</label>
                          <select name="payment_method" x-model="payment_method"  class="form-control form-control-sm" required>
                            <option value="Cash">Cash</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="Neft">Neft</option>
                            <option value="UPI">UPI</option>
                            <option value="Cheque">Cheque</option>
                            <option value="Others">Others</option>
                          </select>
                        </div>

                        <div class="form-group col-md-3 col-sm-12" x-show="payment_method == 'Bank Transfer'">
                          <label>Bank Name</label>
                          <input type="text" name="bank_name" class="form-control form-control-sm"/>
                        </div>


                        <div class="form-group col-md-3 col-sm-12" x-show="payment_method == 'Bank Transfer'">
                          <label>Acc No</label>
                          <input type="text" name="acc_no" class="form-control form-control-sm" :required="payment_method == 'Bank Transfer'"/>
                        </div>



                        <div class="form-group col-md-3 col-sm-12" x-show="payment_method == 'Bank Transfer'">
                          <label>IFSC Code</label>
                          <input type="text" name="ifsc_code" class="form-control form-control-sm" />
                        </div>


                        <div class="form-group col-md-3 col-sm-12" x-show="payment_method == 'UPI'">
                          <label>Transaction Id</label>
                          <input type="text" name="transaction_id" class="form-control form-control-sm" :required="payment_method == 'UPI'" />
                        </div>


                        <div class="form-group col-md-3 col-sm-12" x-show="payment_method == 'UPI'">
                          <label>UPI Id</label>
                          <input type="text" name="upi_id" class="form-control form-control-sm"/>
                        </div>
                        @if($admission->concessions() == 'Not Apply Concession')

                        <div class="form-group col-md-3 col-sm-12">
                          <label>Concession Type</label>
                          <select name="concession_type" x-model="concession_type" class="form-control form-control-sm" required>
                            <option value="manual">Manual</option>
                            <option value="percentage">Percentage</option>
                          </select>
                        </div>
                        
                        <div class="form-group col-md-3 col-sm-12"> 
                          <label>Concession</label>
                          <input type="number" name="concession_amt" step="any" min="0" class="form-control form-control-sm" required/>
                        </div>



                        @endif
                       
                        <div class="form-group col-md-3 col-sm-12">
                          <label>Remarks</label>
                          <textarea name="remarks" class="form-control form-control-sm" cols="30" rows="10"></textarea>
                          <input type="hidden" name="course_fee" x-model="course_fee" />
                        </div>
                        <div class="form-group col-md-12 col-sm-12">
                          <button type="submit" class="btn btn-primary" :disabled="course_fee < 0">Submit</button>
                          <p class="text-danger">Pending Fees: <b x-text="course_fee.toFixed(2)"></b></p>
                        </div>
                </div>
                </form>
                
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
  const name = new TomSelect('#name');
  document.addEventListener('alpine:init', () => {
  Alpine.data('app', () => ({
    payment_method:"Cash",
    options : @json($names),
    mobile_no : null,
    course:null,
    concession_type:"manual",
    course_fee : Number({{ $course_fee }}),
    getdata(val) {
      const option = this.options.find(option => option.name === val);
      this.course = option.course_id;
      this.mobile_no = option.mobile_no;
    },
    init() {
      this.options.forEach((option) => {
        name.addOption({text: `${option.name} (${option.course.title})`,value: option.name,});
      })
    },
 })
  )})
</script>
@endsection