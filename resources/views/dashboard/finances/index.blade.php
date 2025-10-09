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

<!-- finances List Table -->
<div class="card">
  <div class="card-header border-bottom">
    <h5 class="card-title">finances

        <a href='{{url("finances/create")}}'
                class='add-new btn btn-primary float-end' >Add</a>

    </h5>

  </div>


  <div class="card-datatable table-responsive">
  <table class="datatables-users table border-top">
    <thead>
      <tr>
        <th>ID</th>
        <th>Type</th>
        <th>Name</th>
        <th>Amount</th>
        <th>Date</th>
        <th>Comment</th>
        <th>Flock</th>
        <th>Farm</th>
        <th>Picture</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($list as $r)
        <tr>
          <td>{{$loop->index+1}}</td>
          <td>
            <span class="badge
            @if($r->type == "capital") bg-info
            @elseif($r->type == "income") bg-success
            @elseif($r->type == "expense") bg-danger
            @elseif($r->type == "debt") bg-warning
            @elseif($r->type == "loan") bg-secondary
            @endif

             text-white">{{$r->type}}</span>
          </td>
          <td>{{$r->name}}</td>
          <td>{{number_format($r->amount)}}</td>
          <td>{{$r->date}}</td>
          <td>{{$r->comment}}</td>
          <td>{{$r->flock->name}}</td>
          <td>{{$r->farm->name}}</td>
          <td>
            @if($r->picture)
              <a href="{{ $r->picture }}" target="_blank">Open</a>
            @endif
          </td>
          <td>{{$r->status}}</td>
          <td>
            <div class="row w-100">
              @include("dashboard.components.pato_edit",[ "route" => "finances.edit","id" => $r->id])
              @include("dashboard.components.pato_delete",[ "route" => "finances.destroy","id" => $r->id])
            </div>
          </td>

        </tr>
      @endforeach
    </tbody>
  </table>
</div>
</div>
@endsection
