@extends('layouts.app')
@section('title', 'Settings Details')
@section('main')
<div class="main-content">
   <section class="section">
  
      <div class="section-body" x-data="app"> 
          <div class="row">
              <div class="col-12">
                  <div class="card card-primary">
                     <form method="post" id="myForm" action="{{ route('settings.store') }}" enctype="multipart/form-data">
                        @csrf
                      <div class="card-body">
                      <div class="row">


                      <div class="form-group col-lg-4">
                           <label>Option Type</label>
                            <select name="type" class="form-control form-control-sm @error('type') is-invalid @enderror" x-model="type">
                              <option value="">Select Type</option>
                              <option value="text">Text</option>
                              <option value="number">Number</option>
                              <option value="file">File</option>
                            </select>
                            @error('type')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                       </div>

                        <div class="form-group col-lg-4">
                           <label>Attribute</label>
                            <input type="text" name="attribute" class="form-control form-control-sm @error('attribute') is-invalid @enderror" required>
                            @error('attribute')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                       </div>

                     

                       <div class="form-group col-lg-4">
                        <label>Default Value</label>
                         <input :type="type" :accept="type === 'file' ? 'image/*,application/pdf' : ''" name="value" class="form-control form-control-sm @error('value') is-invalid @enderror"  required>
                         @error('value')
                         <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                         @enderror
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

  document.addEventListener('alpine:init', () => {
      Alpine.data('app', () => ({
          type: '',
      }))
  })
  
</script>
@endsection