@extends('layouts.app')
@section('title', 'Settings Details')
@section('css')
<link rel="stylesheet" href="{{asset('bundles/datatables/datatables.min.css')}}">
<link rel="stylesheet" href="{{asset('bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
@endsection
@section('main')
<div class="main-content">
   <section class="section">

    <div class="section-body"> 
        <div class="row">
            <div class="col-12">
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible show fade"> {{ session('success') }} </div>
            @endif
                 
        
                <div class="card card-primary">
  
                    <div class="card-body">
  
                    <div class="row">
                    <div class="col-10 mb-3">
                    <h6 class="col-deep-purple">Settings Details</h6>
                    </div>
                    <div class="col-2 mb-3">
                      <a href="{{route('settings.create')}}" class="btn btn-primary btn-block">Add Setting</a>
                    </div>
                    </div>
                    <div class="col-12">
                    <div class="table-responsive">
      <table class="table table-striped table-sm" id="myTable">
  
      <thead>
        <tr role="row">
          <th>#</th>
          <th>Attribute</th>
          <th>Option Type</th>
          <th>Default Value</th>
          <th>Delete</th>
        </tr>
        </thead>
  
        <tbody>
          @foreach ($settings as $key => $setting)

          <tr>

            <td>{{$key+1}}</td>

            <td>{{$setting->attribute}}</td>

            <td>{{$setting->type}}</td>

            <td>{!! $setting->type != 'file' ? $setting->value : '<a href="'.Storage::disk('public')->url($setting->value).'" class="btn btn-primary" target="_blank">View</a>' !!}</td>

      

           
            <td>
              <form action="{{route('settings.destroy', $setting->id)}}" onsubmit="return confirm('Are you sure?')" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
              </form>
            </td>
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

   </section>
</div>
@endsection

@section('js')
<script src="{{asset('bundles/datatables/datatables.min.js')}}"></script>
<script src="{{asset('bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
<script>
  const table = $('#myTable').DataTable({

    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],

  });

</script>
@endsection