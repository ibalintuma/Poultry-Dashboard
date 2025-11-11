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

<!-- contacts List Table -->
<div class="card">
  <div class="card-header border-bottom">
    <h5 class="card-title">contacts

        <a href='{{url("contacts/create")}}'
                class='add-new btn btn-primary float-end' >Add</a>

    </h5>

  </div>


  <div class="card-datatable table-responsive">
    <table class="datatables-users table border-top">
      <thead>
        <tr>
          <th>ID</th>
          <th>name</th>
          <th>phone</th>
          <th>role</th>
          <th>type</th>
          <th>comment</th>
          <th>address</th>
          <th>status</th>
          <th>email</th>
          <th>email Notification</th>
          <th>SMS Notification</th>
          <th>Action</th>
          <th>Action</th>
        </tr>
      </thead>

      @foreach($list as $r)

        <tr>
          <td>{{$r->id}}</td>
          <td>{{$r->name}}</td>
          <td>{{$r->phone}}</td>
          <td>{{$r->role}}</td>
          <td>{{$r->type}}</td>
          <td>{{$r->comment}}</td>
          <td>{{$r->address}}</td>
          <td>{{$r->status}}</td>
          <td>{{$r->email}}</td>
          <td>{{$r->enable_email_notifications == 1 ? "Yes" : "No" }}</td>
          <td>{{$r->enable_sms_notifications == 1 ? "Yes" : "No" }}</td>
          <td>
            <div class="d-inline-block text-nowrap">
              <a href='{{url("contacts/".$r->id."/edit")}}'>
                <button class="btn btn-sm btn-icon delete-record text-primary">
                  <i class="bx bx-edit"> Edit</i>
                </button>
              </a>
            </div>
          </td>
          <td>
            <div>
              <form action="{{ route('contacts.destroy', $r->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                  <button class="btn btn-sm btn-icon delete-record text-danger">
                    <i class="bx bx-trash"></i> Delete
                  </button>
              </form>
            </div>
          </td>

        </tr>

      @endforeach
    </table>
  </div>
  <!-- Offcanvas to add new contacts -->

</div>
@endsection
