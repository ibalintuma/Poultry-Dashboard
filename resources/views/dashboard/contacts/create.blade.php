<@extends('layouts/layoutMaster')

@section('title', 'contacts')

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
      <h6 id="offcanvasAddUserLabel" class="offcanvas-title">Add contacts</h6>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0">

      <form action='{{url("contacts")}}' method='post' enctype='multipart/form-data'>

        @csrf

        <div class="row">

        <div class='mb-3'>
          <label for="defaultFormControlInput" class="form-label">name</label>
          <input type="text" class="form-control"
                 name='name'
                 id="defaultFormControlInput" aria-describedby="defaultFormControlHelp" />
        </div>

        <div class='mb-3 col-6'>
                  <label for="defaultFormControlInput" class="form-label">phone</label>
                  <input type="text" class="form-control"
                         name='phone'
                         id="defaultFormControlInput" aria-describedby="defaultFormControlHelp" />
                </div>


          <div class='mb-3 col-6'>
            <label for="defaultFormControlInput" class="form-label">email</label>
            <input type="email" class="form-control"
                   name='email'
                   id="defaultFormControlInput" aria-describedby="defaultFormControlHelp" />
          </div>

          <div class='mb-3 col-6'>
            <label for="defaultFormControlInput" class="form-label">Enable SMS notifications</label>
            <select class="form-select" name="enable_sms_notifications" id="enable_sms_notifications" required>
              <option value="0">No</option>
              <option value="1">Yes</option>
            </select>
          </div>

          <div class='mb-3 col-6'>
            <label for="defaultFormControlInput" class="form-label">Enable Email Notifications</label>
            <select class="form-select" name="enable_email_notifications" id="enable_email_notifications" required>
              <option value="0">No</option>
              <option value="1">Yes</option>
            </select>
          </div>

          <div class='mb-3 col-6'>
            <label for="defaultFormControlInput" class="form-label">address</label>
            <input type="text" class="form-control"
                   name='address'
                   id="defaultFormControlInput" aria-describedby="defaultFormControlHelp" />
          </div>

          <div class='mb-3 col-6'>
            <label for="defaultFormControlInput" class="form-label">type</label>
            <input type="text" class="form-control"
                   name='type'
                   value="staff"
                   id="defaultFormControlInput" aria-describedby="defaultFormControlHelp" />
          </div>

        <div class='mb-3 col-6'>
                  <label for="defaultFormControlInput" class="form-label">role/position/duty</label>
                  <input type="text" class="form-control"
                         name='role'
                         id="defaultFormControlInput" aria-describedby="defaultFormControlHelp" />
                </div>
        <div class='mb-3 col-6'>
                  <label for="defaultFormControlInput" class="form-label">comment</label>
                  <input type="text" class="form-control"
                         name='comment'
                         id="defaultFormControlInput" aria-describedby="defaultFormControlHelp" />
                </div>



        <div class='mb-3 col-6'>
                  <label for="defaultFormControlInput" class="form-label">status</label>
                  <select class="form-select" name="status" id="status" required>
                    <option value="active">active</option>
                    <option value="inactive">inactive</option>
                  </select>
                </div>
        </div>


        <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
        <a href='{{url()->previous()}}' class="btn btn-label-secondary">Cancel</a>

      </form>
    </div>
  </div>
</div>
@endsection
