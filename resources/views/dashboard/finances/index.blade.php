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
    <h5 class="card-title">Finances

        <a href='{{url("finances/create")}}'
                class='add-new btn btn-primary float-end' >Add</a>

    </h5>

  </div>


  <div class="card-datatable table-responsive">
  <table class="datatables-users table border-top">
    <thead>
      <tr>
        <th>Date</th>
        <th>Type</th>
        <th>Name</th>
        <th>Amount</th>
        <th>Flock</th>
        <th>Farm</th>
        <th>Picture</th>
        <th>Action</th>
        <th>Comment</th>
        <th>Created At</th>
      </tr>
    </thead>
    <tbody>
      @foreach($list as $r)
        <tr
        class="
        @if( $r->type == "debt" && $r->status == "pending")
          bg-label-danger text-dark
        @endif
        "
        >
          <td>
            <span class="text-nowrap" >
              {{ \Carbon\Carbon::parse($r->date)->format(\Carbon\Carbon::parse($r->date)->year == now()->year ? 'M j' : 'M j, Y') }}
            </span>
          </td>
          <td>
            <span class="badge
            @if($r->type == "capital") bg-info
            @elseif($r->type == "income") bg-success
            @elseif($r->type == "expense") bg-danger
            @elseif($r->type == "debt") bg-warning
            @elseif($r->type == "loan") bg-secondary
            @endif
             text-white">{{$r->type}}</span>
            @if($r->type == "debt" || $r->type == "loan")
             <span class="small">{{$r->status}}</span>
            @endif
          </td>
          <td>{{$r->name}}</td>
          <td>
            <b>{{number_format($r->amount)}}</b>
          </td>
          <td>
            <span class="text-nowrap" >
            @isset($r->flock)
            {{$r->flock->name}}
            @endisset
            </span>
          </td>
          <td>
            <span class="text-nowrap" >
            @isset($r->farm)
            {{$r->farm->name}}
            @endisset
            </span>
          </td>
          <td>
            @if($r->picture)
              <a href="{{ $r->picture }}" target="_blank">Open</a>
            @endif
          </td>
          <td>
            <div class="row w-100">
              @include("dashboard.components.pato_edit",[ "route" => "finances.edit","id" => $r->id])
              @include("dashboard.components.pato_delete",[ "route" => "finances.destroy","id" => $r->id])
            </div>
          </td>
          <td>
            <span class="text-nowrap" >
            {{$r->comment}}
            </span>
          </td>
          <td>
            <span class="text-nowrap" >
              {{ \Carbon\Carbon::parse($r->created_at)->format('M j, Y h:i A') }}
            </span>
          </td>

        </tr>
      @endforeach
    </tbody>
  </table>
</div>
</div>
@endsection
