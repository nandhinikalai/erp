@extends('layouts.app')
@section('title', 'Fees List')
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
                    <div class="col-md-6 col-sm-12 mb-3">
                    <h6 class="col-deep-purple">Fees List Details</h6>
                    </div>
                    </div>
                    <div class="col-sm-12">
                    <div class="table-responsive">
      <table class="table table-striped table-sm" id="myTable">
      <thead>
        <tr role="row">
          <th>#</th>
          <th>Title</th>
          <th>Payment Date</th>
          <th>Amount</th>
          <th>Payment Method</th>
          <th>Remarks</th>
          <th>Delete</th>
        </tr>
        </thead>
  
        <tbody>
          @foreach ($admission->fees()->get() as $key => $fee)
          <tr>
            <td>{{$key+1}}</td>

            <td>{{$fee->title}}</td>

            <td>{{$fee->payment_date}}</td>

            <td>{{$fee->amount}}</td>

            <td>{{$fee->payment_method}}</td>

            <td>{{$fee->remarks}}</td>


            <td>
              <form action="{{route('fees.destroy', $fee->id)}}" onsubmit="return confirm('Are you sure?')" method="post">
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