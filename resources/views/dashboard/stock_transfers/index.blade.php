<@extends('layouts/layoutMaster')

@section('title', 'stock_transfers')

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

  @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
      {{ $message }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

<!-- stock_transfers List Table -->
<div class="card">
  <div class="card-header border-bottom">
    <h5 class="card-title">Stock Transfers / Usage

        <a href='{{url("stock_transfers/create")}}'
                class='add-new btn btn-primary float-end' >Add</a>

    </h5>

  </div>

  <div class="card-datatable table-responsive">
    <table class="datatables-users table border-top">
      {{--`date`, `stock_id`, `finance_id`, `quantity`, `direction`, `comment`, `created_at`, `updated_at`, `quantity_before`, `quantity_after`--}}
      <thead>
        <tr>
          <th>Date</th>
          <th>Stock</th>
          <th>quantity</th>
          <th>Finance</th>
          <th>Direction</th>
          <th>Action</th>
          <th>Comment</th>
          <th>quantity before</th>
          <th>quantity after</th>
        </tr>
      </thead>

      @foreach($list as $r)

        <tr
          class="{{ $r->direction == "add" ? 'table-success' : 'table-danger' }}"
        >
          <td class="text-nowrap">{{$r->date}}</td>
          <td class="text-nowrap">{{$r->stock->name}}</td>
          <td class="text-nowrap">
            {{$r->quantity}}
            {{$r->stock->units}}
          </td>
          <td>
            @isset($r->finance)
            {{$r->finance->amount}}
            @endisset
          </td>
          <td>
            @if($r->direction == "add")
              {{--<span class="badge bg-label-success">Add</span>--}}
              <i class="bx bx-up-arrow-circle text-success"></i>
            @else
              {{--<span class="badge bg-label-danger">Subtract</span>--}}
              <i class="bx bx-down-arrow-circle text-danger"></i>
            @endif</td>

          <td>
            <div class="row w-100">
              @include("dashboard.components.pato_edit",[ "route" => "stock_transfers.edit","id" => $r->id])
              @include("dashboard.components.pato_delete",[ "route" => "stock_transfers.destroy","id" => $r->id])
            </div>
          </td>
          <td>{{$r->comment}}</td>
          <td>{{$r->quantity_before}}</td>
          <td>{{$r->quantity_after}}</td>

        </tr>

      @endforeach
    </table>
  </div>
  <!-- Offcanvas to add new stock_transfers -->

</div>
@endsection
