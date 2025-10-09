<@extends('layouts/layoutMaster')

@section('title', 'finances')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />

@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-responsive/datatables.responsive.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-buttons/datatables-buttons.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.js')}}"></script>
<script src="{{asset('assets/vendor/libs/jszip/jszip.js')}}"></script>
<script src="{{asset('assets/vendor/libs/pdfmake/pdfmake.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-buttons/buttons.html5.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-buttons/buttons.print.js')}}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave-phone.js')}}"></script>
@endsection

{{--@section('page-script')
<script src="{{asset('assets/js/app-user-list.js')}}"></script>
@endsection--}}

@section('content')



  @if (count($errors) > 0)
    <div class="alert alert-danger">
      <strong>Whoops!</strong> There were some problems with your input.<br><br>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

<!-- Users List Table -->
<div class="card">


  <!-- Offcanvas to add new user -->
  <div class="" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header border-bottom">
      <h6 id="offcanvasAddUserLabel" class="offcanvas-title">Add finances</h6>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0">

      <form action='{{url("finances")}}' method='post' enctype='multipart/form-data'>

        @csrf
       <div class='mb-3'>
         <label for="type" class="form-label">Type</label>
         <select class="form-select" name="type" id="type" required>
           <option value="">Select type</option>
           <option value="income">Income</option>
           <option value="expense">Expense</option>
           <option value="debt">Debt</option>
           <option value="loan">Loan</option>
           <option value="capital">Capital</option>
         </select>
       </div>

       <div class='mb-3'>
         <label for="name" class="form-label">Name</label>
         <input type="text" class="form-control" name="name" id="name" required />
       </div>

       <div class='mb-3'>
         <label for="amount" class="form-label">Amount</label>
         <input type="number" class="form-control" name="amount" id="amount" step="0.01" required />
       </div>

       <div class='mb-3'>
         <label for="date" class="form-label">Date</label>
         <input type="date" class="form-control" name="date" id="date" required />
       </div>

       <div class='mb-3'>
         <label for="comment" class="form-label">Comment</label>
         <textarea class="form-control" name="comment" id="comment"></textarea>
       </div>

        <div class="mb-3">
                  <label for="exampleFormControlSelect1" class="form-label">flock_id</label>
                  <select class="form-select" id="exampleFormControlSelect1"
                          aria-label="Default select" name='flock_id'>
                          <option value="">Select flock_id</option>
                    @foreach($flocks as $item)
                      <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                  </select>
                </div>


        <div class="mb-3">
                  <label for="exampleFormControlSelect1" class="form-label">farm_id</label>
                  <select class="form-select" id="exampleFormControlSelect1"
                          aria-label="Default select" name='farm_id'>
                          <option value="">Select farm_id</option>
                    @foreach($farms as $item)
                      <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                  </select>
                </div>

       <div class='mb-3'>
         <label for="picture" class="form-label">Picture</label>
         <input type="file" class="form-control" name="picture" id="picture" accept="image/*" />
       </div>

       <div class='mb-3'>
         <label for="status" class="form-label">Status</label>
         <select class="form-select" name="status" id="status" required>
           <option value="pending">Pending</option>
           <option value="completed">Completed</option>
         </select>
       </div>

        <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
        <a href='{{url()->previous()}}' class="btn btn-label-secondary">Cancel</a>

      </form>
    </div>
  </div>
</div>
@endsection
