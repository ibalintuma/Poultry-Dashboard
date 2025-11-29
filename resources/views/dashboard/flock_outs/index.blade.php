<@extends('layouts/layoutMaster')

@section('title', 'Batches Out')

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

<!-- flock_outs List Table -->
<div class="card">
  <div class="card-header border-bottom">
    <h5 class="card-title">Batches Out

        <a href='{{url("flock_outs/create?flock_id=".$flock_id)}}'
                class='add-new btn btn-primary float-end' >Add</a>

    </h5>

  </div>



  <div class="card-datatable table-responsive">
    <table class="datatables-users table border-top">
      <thead>

        <tr>
          <th>date</th>
          <th>flock</th>
          <th>quantity</th>
          <th>age</th>
          <th>type</th>
          <th>reason</th>
          <th>Action</th>
          <th>comment</th>
        </tr>
      </thead>

      @foreach($list as $r)

        <tr>
          <td class="text-nowrap">
            {{ \Carbon\Carbon::parse($r->date)->format(\Carbon\Carbon::parse($r->date)->year == now()->year ? 'M j' : 'M j, Y') }}
          </td>
          <td class="text-nowrap">
            <b>{{$r->flock->name}}</b>
          </td>
          <td>{{$r->quantity}}</td>
          <td class="text-nowrap">
            <b>{{ \Carbon\Carbon::parse($r->flock->date)->diffInDays(\Carbon\Carbon::parse($r->date)) }} days</b>
            <span class="text-muted small">(
            {{ \Carbon\Carbon::parse($r->flock->date)->format(\Carbon\Carbon::parse($r->flock->date)->year == now()->year ? 'M j' : 'M j, Y') }}
            -
            {{ \Carbon\Carbon::parse($r->date)->format(\Carbon\Carbon::parse($r->date)->year == now()->year ? 'M j' : 'M j, Y') }}
            )</span>
          </td>
          <td>
          <span
            class="
              @if($r->type == 'sale')
                badge bg-label-success
              @elseif($r->type == 'loss')
                badge bg-label-danger
              @else
                badge bg-label-warning
              @endif
            "
          >
            {{$r->type}}
          </span>
          </td>
          <td class="text-nowrap">{{$r->reason}}</td>
          <td>
            <div class="row w-100">
              @include("dashboard.components.pato_edit",[ "route" => "flock_outs.edit","id" => $r->id])
              @include("dashboard.components.pato_delete",[ "route" => "flock_outs.destroy","id" => $r->id])
            </div>
          </td>
          <td>{{$r->comment}}</td>

        </tr>

      @endforeach
    </table>
  </div>
  <!-- Offcanvas to add new flock_outs -->

</div>
@endsection
