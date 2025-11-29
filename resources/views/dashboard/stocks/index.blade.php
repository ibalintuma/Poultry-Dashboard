@extends('layouts/layoutMaster')

@section('title', 'stocks')

@section('vendor-style')
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5. css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min. css')}}" />

@endsection

@section('vendor-script')
  <script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/datatables/jquery.dataTables. js')}}"></script>
  <script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/datatables-responsive/datatables.responsive. js')}}"></script>
  <script src="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/datatables-buttons/datatables-buttons.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/jszip/jszip.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/pdfmake/pdfmake.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/datatables-buttons/buttons.html5.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/datatables-buttons/buttons.print.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/select2/select2. js')}}"></script>
  <script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min. js')}}"></script>
  <script src="{{asset('assets/vendor/libs/cleavejs/cleave.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/cleavejs/cleave-phone.js')}}"></script>
@endsection

{{--@section('page-script')
<script src="{{asset('assets/js/app-user-list.js')}}"></script>
@endsection--}}

@section('content')

  @php
    $lowStockCount = $list->filter(function($item) {
      return $item->quantity <= $item->alert_quantity;
    })->count();

    $totalValue = $list->sum(function($item) {
      return $item->quantity * $item->unit_price;
    });
  @endphp

    <!-- Stats Cards -->
  <div class="row mb-4">
    <div class="col-sm-6 col-lg-3 mb-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="avatar avatar-lg flex-shrink-0 me-3">
            <span class="avatar-initial rounded bg-label-primary">
              <i class="bx bx-package"></i>
            </span>
            </div>
            <div>
              <h6 class="mb-0">Total Items</h6>
              <h4 class="mb-0">{{ $list->count() }}</h4>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-lg-3 mb-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="avatar avatar-lg flex-shrink-0 me-3">
            <span class="avatar-initial rounded bg-label-danger">
              <i class="bx bx-error-circle"></i>
            </span>
            </div>
            <div>
              <h6 class="mb-0">Low Stock</h6>
              <h4 class="mb-0 {{ $lowStockCount > 0 ? 'text-danger' : 'text-success' }}">{{ $lowStockCount }}</h4>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-lg-3 mb-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="avatar avatar-lg flex-shrink-0 me-3">
            <span class="avatar-initial rounded bg-label-success">
              <i class="bx bx-wallet"></i>
            </span>
            </div>
            <div>
              <h6 class="mb-0">Total Value</h6>
              <h4 class="mb-0">UGX {{ number_format($totalValue) }}</h4>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-lg-3 mb-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="avatar avatar-lg flex-shrink-0 me-3">
            <span class="avatar-initial rounded bg-label-warning">
              <i class="bx bx-star"></i>
            </span>
            </div>
            <div>
              <h6 class="mb-0">High Priority</h6>
              <h4 class="mb-0">{{ $list->where('priority_level', 'high')->count() }}</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
      {{ $message }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
      {{ $message }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <!-- Low Stock Alert -->
  @if($lowStockCount > 0)
    <div class="alert alert-danger alert-dismissible mb-4" role="alert">
      <div class="d-flex">
        <i class="bx bx-error-circle me-2 fs-4"></i>
        <div>
          <strong>Low Stock Alert! </strong> {{ $lowStockCount }} item(s) are running low on stock and need restocking.
        </div>
      </div>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <!-- stocks List Table -->
  <div class="card">
    <div class="card-header border-bottom">
      <div class="d-flex justify-content-between align-items-center flex-wrap">
        <h5 class="card-title mb-0">
          <i class="bx bx-package me-2"></i>Stock Inventory
        </h5>
        <div class="d-flex gap-2">
          <a href='{{url("stock_transfers")}}'
             class='btn btn-outline-secondary'>
            <i class="bx bx-transfer-alt me-1"></i> View Transfers
          </a>
          <a href='{{url("stock_quantities")}}'
             class='btn btn-outline-secondary'>
            <i class="bx bx-calculator me-1"></i> View Quantities
          </a>
          <a href='{{url("stocks/create")}}'
             class='add-new btn btn-primary'>
            <i class="bx bx-plus me-1"></i> Add Stock
          </a>
        </div>
      </div>
    </div>


    <div class="card-datatable table-responsive">
      <table class="datatables-users table border-top">
        {{--`name`, `units`, `comment`, `picture`, `alert_quantity`, `priority_level`, `unit_price`, `supplier_id`--}}
        <thead>
        <tr>
          <th>Stock Item</th>
          <th>Quantity</th>
          <th>Stock Level</th>
          <th>Unit Price</th>
          <th>Total Value</th>
          <th>Priority</th>
          <th>Supplier</th>
          <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $r)
          @php
            $isLowStock = $r->quantity <= $r->alert_quantity;
            $stockPercentage = $r->alert_quantity > 0 ? min(($r->quantity / ($r->alert_quantity * 2)) * 100, 100) : 100;
            $progressColor = $stockPercentage <= 25 ? 'bg-danger' : ($stockPercentage <= 50 ? 'bg-warning' : 'bg-success');
            $rowValue = $r->quantity * $r->unit_price;
          @endphp

          <tr class="{{ $isLowStock ? 'table-danger' : '' }}">
            <td>
              <div class="d-flex align-items-center text-nowrap">
                @if($r->picture)
                  <img src="{{ $r->picture }}" alt="{{ $r->name }}" class="rounded me-3" width="45" height="45" style="object-fit: cover;">
                @else
                  <div class="avatar avatar-sm me-3">
                  <span class="avatar-initial rounded bg-label-secondary">
                    <i class="bx bx-package"></i>
                  </span>
                  </div>
                @endif
                <div>
                  <h6 class="mb-0 fw-semibold">{{ $r->name }}</h6>
                  @if($r->comment)
                    <small class="text-muted">{{ Str::limit($r->comment, 30) }}</small>
                  @endif
                </div>
              </div>
            </td>
            <td class="text-nowrap">
              <div class="d-flex align-items-center">
              <span class="fw-semibold me-2 {{ $isLowStock ? 'text-danger' : '' }}">
                {{ number_format($r->quantity) }}
              </span>
                <span class="text-muted">{{ $r->units }}</span>
                <div class="ms-2">
                  <a href="{{ url("stock_transfers/create? direction=add&stock_id=".$r->id) }}"
                     class="btn btn-icon btn-sm btn-success"
                     data-bs-toggle="tooltip"
                     title="Add Stock">
                    <i class="bx bx-plus"></i>
                  </a>
                  <a href="{{ url("stock_transfers/create?direction=subtract&stock_id=".$r->id) }}"
                     class="btn btn-icon btn-sm btn-danger"
                     data-bs-toggle="tooltip"
                     title="Use Stock">
                    <i class="bx bx-minus"></i>
                  </a>
                </div>
              </div>
            </td>
            <td style="min-width: 200px;">
              <div class="d-flex flex-column">
                <div class="d-flex justify-content-between mb-1">
                  <small class="text-muted">Alert: {{ number_format($r->alert_quantity) }}</small>
                  @if($isLowStock)
                    <span class="badge bg-danger">Low Stock</span>
                  @else
                    <span class="badge bg-success">In Stock</span>
                  @endif
                </div>

              </div>

            </td>
            <td class="text-nowrap">
              <span class="fw-semibold">UGX {{ number_format($r->unit_price) }}</span>
              <small class="text-muted d-block">per {{ $r->units }}</small>
            </td>
            <td class="text-nowrap">
              <span class="fw-semibold">UGX {{ number_format($rowValue) }}</span>
            </td>
            <td class="text-nowrap">
              @if($r->priority_level == 'high')
                <span class="badge bg-label-danger">
                <i class="bx bx-up-arrow-alt"></i> High
              </span>
              @elseif($r->priority_level == 'medium')
                <span class="badge bg-label-warning">
                <i class="bx bx-minus"></i> Medium
              </span>
              @else
                <span class="badge bg-label-secondary">
                <i class="bx bx-down-arrow-alt"></i> Low
              </span>
              @endif
            </td>
            <td class="text-nowrap">
              @if($r->supplier)
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-xs me-2">
                  <span class="avatar-initial rounded-circle bg-label-info">
                    {{ strtoupper(substr($r->supplier->name, 0, 1)) }}
                  </span>
                  </div>
                  <span>{{ $r->supplier->name }}</span>
                </div>
              @else
                <span class="text-muted">N/A</span>
              @endif
            </td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('stocks.edit', $r->id) }}">
                    <i class="bx bx-edit-alt me-2"></i> Edit
                  </a>
                  <a class="dropdown-item" href="{{ url('stock_transfers? stock_id='.$r->id) }}">
                    <i class="bx bx-transfer-alt me-2"></i> View Transfers
                  </a>
                  <a class="dropdown-item" href="{{ url('stock_quantities?stock_id='.$r->id) }}">
                    <i class="bx bx-calculator me-2"></i> View Quantities
                  </a>
                  <div class="dropdown-divider"></div>
                  <form action="{{ route('stocks.destroy', $r->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item text-danger"
                            onclick="return confirm('Are you sure you want to delete this stock item?')">
                      <i class="bx bx-trash me-2"></i> Delete
                    </button>
                  </form>
                </div>
              </div>
            </td>
          </tr>

        @endforeach
        </tbody>
      </table>
    </div>
  </div>

@endsection

@section('page-script')
  <script>
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
  </script>
@endsection
