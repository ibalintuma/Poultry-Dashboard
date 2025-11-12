@extends('layouts/layoutMaster')

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

  @php
    // Calculate totals by type
    $totalCapital = $list->where('type', 'capital')->sum('amount');
    $totalIncome = $list->where('type', 'income')->sum('amount');
    $totalExpense = $list->where('type', 'expense')->sum('amount');
    $totalDebt = $list->where('type', 'debt')->sum('amount');
    $totalLoan = $list->where('type', 'loan')->sum('amount');
    $grandTotal = $list->sum('amount');
    $netAmount = $totalCapital + $totalIncome - $totalExpense;
  @endphp

  <div class="mb-3">
    <div class="btn-group" role="group" aria-label="Filter by type">
      <a href="{{ url('finances') }}" class="btn btn-sm {{ !request('type') ? 'btn-primary' : 'btn-outline-primary' }}">All</a>
      <a href="{{ url('finances?type=capital') }}" class="btn btn-sm {{ request('type') == 'capital' ? 'btn-info' : 'btn-outline-info' }}">Capital</a>
      <a href="{{ url('finances?type=income') }}" class="btn btn-sm {{ request('type') == 'income' ? 'btn-success' : 'btn-outline-success' }}">Income</a>
      <a href="{{ url('finances?type=expense') }}" class="btn btn-sm {{ request('type') == 'expense' ? 'btn-danger' : 'btn-outline-danger' }}">Expense</a>
      <a href="{{ url('finances?type=debt') }}" class="btn btn-sm {{ request('type') == 'debt' ? 'btn-warning' : 'btn-outline-warning' }}">Debt</a>
      <a href="{{ url('finances?type=loan') }}" class="btn btn-sm {{ request('type') == 'loan' ? 'btn-secondary' : 'btn-outline-secondary' }}">Loan</a>
    </div>
  </div>

  <!-- finances List Table -->
  <div class="card">
    <div class="card-header border-bottom">
      <h5 class="card-title">Finances

        <a href='{{url("finances/create")}}'
           class='add-new btn btn-primary float-end' >Add</a>

      </h5>
    </div>


    <div class="card-datatable table-responsive">
      <table class="datatables-users table border-top table-hover ">
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
          <th>Contact</th>
          <th>Parent/Capital</th>
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
            <td>
              <div style="width: 300px">
                {{$r->name}}
              </div>
            </td>
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
            <td class="text-nowrap">
              @isset($r->contact)
                {{$r->contact->name}}
              @endisset
            </td>
            <td class="text-nowrap">
              @isset($r->parent)
                <a href="{{url("finances?parent_id=".$r->parent_id)}}" class="text-success">UGX <b>{{number_format($r->parent->amount)}}</b></a>
              @endisset
            </td>
            <td>
            <span class="text-nowrap" >
              {{ \Carbon\Carbon::parse($r->created_at)->format('M j, Y h:i A') }}
            </span>
            </td>

          </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr class="table-primary fw-bold">
          <td colspan="3" class="text-end"><strong>TOTAL:</strong></td>
          <td><strong>UGX {{ number_format($grandTotal) }}</strong></td>
          <td colspan="8"></td>
        </tr>
        </tfoot>
      </table>
    </div>
  </div>


  <!-- Summary Cards -->
  <div class="row mt-3">
    <div class="col-md-3">
      <div class="card bg-info text-white">
        <div class="card-body p-3">
          <small>Capital</small>
          <h5 class="mb-0">UGX {{ number_format($totalCapital) }}</h5>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bg-success text-white">
        <div class="card-body p-3">
          <small>Income</small>
          <h5 class="mb-0">UGX {{ number_format($totalIncome) }}</h5>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bg-danger text-white">
        <div class="card-body p-3">
          <small>Expense</small>
          <h5 class="mb-0">UGX {{ number_format($totalExpense) }}</h5>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bg-warning text-dark">
        <div class="card-body p-3">
          <small>Debt</small>
          <h5 class="mb-0">UGX {{ number_format($totalDebt) }}</h5>
        </div>
      </div>
    </div>
    <div class="col-md-2 d-none">
      <div class="card bg-secondary text-white">
        <div class="card-body p-3">
          <small>Loan</small>
          <h5 class="mb-0">UGX {{ number_format($totalLoan) }}</h5>
        </div>
      </div>
    </div>
    <div class="col-md-2 d-none">
      <div class="card bg-primary text-white">
        <div class="card-body p-3">
          <small>Net Amount</small>
          <h5 class="mb-0">UGX {{ number_format($netAmount) }}</h5>
        </div>
      </div>
    </div>
  </div>

@endsection
