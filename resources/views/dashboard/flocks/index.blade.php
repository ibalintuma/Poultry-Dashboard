@extends('layouts/layoutMaster')

@section('title', 'Batches')

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

<!-- Batches List Table -->
<div class="card">
  <div class="card-header border-bottom">
    <h5 class="card-title">Batches

        <a href='{{url("flocks/create")}}'
                class='add-new btn btn-primary float-end' >Add</a>

    </h5>

  </div>


  <div class="card-datatable table-responsive">
    <table class="datatables-users table border-top">
      <thead>
        <tr>
          <th>Name</th>
          <th>qty now</th>
          <th>date brought</th>
          <th>farm</th>
          <th>type</th>
          <th>Action</th>
          <th>qty Initial</th>
          <th>qty Sold</th>
          <th>qty Dead</th>
          <th>Avg. Weight</th>
          <th>seller</th>
          <th>status</th>
          <th>comment</th>
        </tr>
      </thead>

      @foreach($list as $r)

        <tr class="
        @if($r->status == "ongoing")
        bg-label-success text-dark
        @endif
        ">
          <td>
            <span class="text-nowrap" >
            {{$r->name}}
            </span>
          </td>
          <td>
            <div class="d-flex flex-row justify-content-center align-items-center">
              <span class="m-1">
                <b>{{$r->quantity_current}}</b>
              </span>
              <a href="{{url("flock_outs/create?flock_id=".$r->id)}}" class="badge bg-danger text-white m-1" >-</a>
            </div>
          </td>
          <td>
            <span class="text-nowrap" >
            {{ \Carbon\Carbon::parse($r->date)->format(\Carbon\Carbon::parse($r->date)->year == now()->year ? 'M j' : 'M j, Y') }}
              @if( $r->status == "ongoing")
                <span class="text-muted">({{ \Carbon\Carbon::parse($r->date)->diffInDays()|round(0, PHP_ROUND_HALF_DOWN) }} days ago)</span>
              @endif
            </span>
          </td>
          <td>
            <span class="text-nowrap" >
            {{$r->farm->name}}
            </span>
          </td>
          <td>{{$r->type}}</td>
          <td>
            <div class="row w-100">
              @include("dashboard.components.pato_edit",[ "route" => "flocks.edit","id" => $r->id])
              @include("dashboard.components.pato_delete",[ "route" => "flocks.destroy","id" => $r->id])
            </div>
          </td>
          <td>{{$r->quantity}}</td>
          <td>
            <div class="d-flex flex-row justify-content-center align-items-center">
              <a href="{{url("flock_outs?type=sold&flock_id=".$r->id)}}">
              {{$r->quantity_out_sold}}
              </a>
            </div>
          </td>
          <td>
            <div class="d-flex flex-row justify-content-center align-items-center">
              <a href="{{url("flock_outs?type=died&flock_id=".$r->id)}}">
              {{$r->quantity_out_dead}}
              </a>
            </div>
          </td>
          <td class="text-nowrap">
            @if($r->average_weight != null)
            {{number_format($r->average_weight,3)}}
            @else
              ?
            @endif
              Kg
            <a href="{{url("flock_weights/create?flock_id=".$r->id)}}" class="badge bg-danger text-white m-1" >+</a>
          </td>
          <td class="text-nowrap">{{$r->seller}}</td>
          <td>
            <span class="badge bg-dark text-white">
              {{$r->status}}
            </span>
          </td>
          <td>
            <div class="text-wrap" style="width: 300px;">
              {{$r->comment}}
            </div>
          </td>

        </tr>

      @endforeach
    </table>
  </div>
  <!-- Offcanvas to add new flocks -->

</div>
@endsection
