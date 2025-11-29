@extends('layouts/layoutMaster')

@section('title', 'stock_quantities')

@section('vendor-style')
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />

@endsection

@section('vendor-script')
  <script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/datatables/jquery.dataTables. js')}}"></script>
  <script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/datatables-responsive/datatables.responsive.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/datatables-buttons/datatables-buttons.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/jszip/jszip.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/pdfmake/pdfmake.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/datatables-buttons/buttons.html5.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/datatables-buttons/buttons.print.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/select2/select2. js')}}"></script>
  <script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5. min.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus. min.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/cleavejs/cleave.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/cleavejs/cleave-phone.js')}}"></script>
@endsection

{{--@section('page-script')
<script src="{{asset('assets/js/app-user-list.js')}}"></script>
@endsection--}}

@section('content')

  @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
      {{ $message }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <!-- stock_quantities List Table -->
  <div class="card">
    <div class="card-header border-bottom">
      <h5 class="card-title">Stock Quantities

        <a href='{{url("stock_quantities/create")}}'
           class='add-new btn btn-primary float-end' >Add</a>

      </h5>

    </div>

    <div class="card-datatable table-responsive">
      <table class="datatables-users table border-top">
        {{--`date`, `stock_id`, `type`, `quantity`, `comment`, `created_at`, `updated_at`--}}
        <thead>
        <tr>
          <th>Date</th>
          <th>Stock</th>
          <th>Type</th>
          <th>Quantity</th>
          <th>Comment</th>
          <th>Action</th>
        </tr>
        </thead>

        @foreach($list as $r)

          <tr
            class="{{ $r->type == "manual" ? 'table-warning' : 'table-info' }}"
          >
            <td class="text-nowrap">{{$r->date}}</td>
            <td class="text-nowrap">{{$r->stock->name}}</td>
            <td class="text-nowrap">
              @if($r->type == "manual")
                <span class="badge bg-label-warning">Manual</span>
              @else
                <span class="badge bg-label-info">Auto</span>
              @endif
            </td>
            <td class="text-nowrap">
              {{$r->quantity}}
              {{$r->stock->units}}
            </td>
            <td>{{$r->comment}}</td>

            <td>
              <div class="row w-100">
                @include("dashboard.components.pato_edit",[ "route" => "stock_quantities.edit","id" => $r->id])
                @include("dashboard.components.pato_delete",[ "route" => "stock_quantities.destroy","id" => $r->id])
              </div>
            </td>

          </tr>

        @endforeach
      </table>
    </div>
    <!-- Offcanvas to add new stock_quantities -->

  </div>
@endsection
