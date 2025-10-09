<@extends('layouts/layoutMaster')

@section('title', 'stocks')

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

<!-- stocks List Table -->
<div class="card">
  <div class="card-header border-bottom">
    <h5 class="card-title">Stocks

        <a href='{{url("stocks/create")}}'
                class='add-new btn btn-primary float-end' >Add</a>

    </h5>

  </div>


  <div class="card-datatable table-responsive">
    <table class="datatables-users table border-top">
      <thead>
        <tr>
          <th>Name</th>
          <th>Quantity</th>
          <th>Comment</th>
          <th>Farm</th>
          <th>Picture</th>
          <th>Action</th>
        </tr>
      </thead>

      @foreach($list as $r)

        <tr>
          <td>
            {{$r->name}}
          </td>
          <td>
            <div class="d-flex flex-row justify-content-center align-items-center">
              <span class="m-1">{{ number_format($r->quantity_current) }}</span>
              <span class="m-1">{{$r->units}}</span>
              <a href="{{ url("stock_transfers/create?direction=add&stock_id=".$r->id) }}" class="badge bg-success text-white m-1">+</a>
              <a href="{{ url("stock_transfers/create?direction=subtract&stock_id=".$r->id) }}" class="badge bg-danger text-white m-1">-</a>
            </div>
          </td>

          <td>{{$r->comment}}</td>
          <td>{{$r->farm->name}}</td>
          <td>
            @if($r->picture)
              <img src="{{ $r->picture }}" alt="Picture" class="me-2" width="50" height="50">
            @else
              N/A
            @endif
          </td>
          <td>
            <div class="row w-100">
              @include("dashboard.components.pato_edit",[ "route" => "stocks.edit","id" => $r->id])
              @include("dashboard.components.pato_delete",[ "route" => "stocks.destroy","id" => $r->id])
            </div>
          </td>
        </tr>

      @endforeach
    </table>
  </div>
  <!-- Offcanvas to add new stocks -->

</div>
@endsection
>
