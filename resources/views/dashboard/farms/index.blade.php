@extends('layouts/layoutMaster')

@section('title', 'farms')

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

<!-- farms List Table -->
<div class="card">
  <div class="card-header border-bottom">
    <h5 class="card-title">Farms

        <a href='{{url("farms/create")}}'
                class='add-new btn btn-primary float-end' >Add</a>

    </h5>

  </div>


  <div class="card-datatable table-responsive">
    <table class="datatables-users table border-top">
      <thead>
        <tr>
          <th>#</th>
          <th>name</th>
          <th>Total Flock</th>
          <th>Created By</th>
          <th>Action</th>
        </tr>
      </thead>

      @foreach($list as $r)

        <tr>
          <td>{{$loop->index + 1}}</td>
          <td>{{$r->name}}</td>
          <td>{{number_format($r->total_flock)}}</td>
          <td>
            @isset($r->user)
            {{$r->user->name}}
            @endisset
          </td>
          <td>
            <div class="row w-100">
              @include("dashboard.components.pato_edit",[ "route" => "farms.edit","id" => $r->id])
              @include("dashboard.components.pato_delete",[ "route" => "farms.destroy","id" => $r->id])
            </div>
          </td>

        </tr>

      @endforeach
    </table>
  </div>
  <!-- Offcanvas to add new farms -->

</div>
@endsection
