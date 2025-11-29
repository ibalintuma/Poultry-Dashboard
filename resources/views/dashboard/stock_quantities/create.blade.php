@extends('layouts/layoutMaster')

@section('title', 'stock_quantities')

@section('vendor-style')
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables. bootstrap5.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive. bootstrap5.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons. bootstrap5.css')}}">
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
  <script src="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5. js')}}"></script>
  <script src="{{asset('assets/vendor/libs/jszip/jszip.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/pdfmake/pdfmake.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/datatables-buttons/buttons.html5.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/datatables-buttons/buttons.print. js')}}"></script>
  <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min. js')}}"></script>
  <script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min. js')}}"></script>
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
      <strong>Whoops!</strong> There were some problems with your input. <br><br>
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
        <h6 id="offcanvasAddUserLabel" class="offcanvas-title">Add Stock Quantity</h6>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body mx-0 flex-grow-0">

        <form action='{{url("stock_quantities")}}' method='post' enctype='multipart/form-data'>

          @csrf


          <div class="mb-3">
            <label for="exampleFormControlSelect1" class="form-label">Stock</label>
            <select class="form-select" id="exampleFormControlSelect1"
                    aria-label="Default select"
                    @isset($stock_id) readonly  @endisset
                    name='stock_id'>
              <option value="">Select </option>
              @foreach($stocks as $item)
                <option value="{{$item->id}}"
                        @if($stock_id == $item->id) selected @endif
                >{{$item->name}} ({{$item->units}})</option>
              @endforeach
            </select>
          </div>


          <div class='mb-3'>
            <label for="defaultFormControlInput" class="form-label">Quantity</label>
            <input type="text" class="form-control"
                   name='quantity'
                   id="defaultFormControlInput" aria-describedby="defaultFormControlHelp" />
          </div>

          <div class='mb-3'>
            <label for="defaultFormControlInput" class="form-label">Comment</label>
            <input type="text" class="form-control"
                   name='comment'
                   id="defaultFormControlInput" aria-describedby="defaultFormControlHelp" />
          </div>

          <div class='mb-3'>
            <label for="defaultFormControlInput" class="form-label">Date</label>
            <input type="date" class="form-control"
                   name='date'
                   value="{{date('Y-m-d')}}"
                   id="defaultFormControlInput" aria-describedby="defaultFormControlHelp" />
          </div>

          <input type="text" value="{{url()->previous()}}" name="previous_url" class="d-none">

          <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
          <a href='{{url()->previous()}}' class="btn btn-label-secondary">Cancel</a>

        </form>
      </div>
    </div>
  </div>
@endsection
