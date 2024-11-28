@extends('layouts.app')
@section('title', 'Settings Details')
@section('main')
<div class="main-content">
   <section class="section">
  
      <div class="section-body"> 
          <div class="row">
              <div class="col-12">
                  <div class="card card-primary">
                     <form method="post" action="{{ route('settings.update', $setting->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                      <div class="card-body">
    
                        <div class="row">
                          <div class="form-group col-lg-4">
                             <label>Option</label>
                              <input type="text" name="attribute" value="{{$setting->attribute}}" class="form-control form-control-sm @error('attribute') is-invalid @enderror" required>
                              @error('attribute')
                              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                              @enderror
                         </div>
  
                         <div class="form-group col-lg-4">
                          <label>Value</label>
                           <input type="text" name="value" value="{{$setting->value}}" class="select @error('value') is-invalid @enderror" required>
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