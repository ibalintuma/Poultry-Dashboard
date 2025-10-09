<div class="page-header">
  <div class="d-flex flex-row align-items-center justify-content-between">
    <div class="text-end">
      <a href="{{ url()->previous() }}" class="btn btn-outline-secondary text-white">
        <i class="bx bx-arrow-back me-2"></i> Back
      </a>
    </div>

    <div class="flex-grow-1 text-center">
      <h2 class="mb-1 fw-bold">
        {{$title}}
      </h2>
      <p class="mb-0 text-muted">{{$subtitle}}</p>
    </div>

    <div class="text-end">

      <a href="{{ route($create_route) }}" class="btn bg-warning text-white">
        <i class="bx bx-plus-circle me-2"></i>{{$create_title}}
      </a>
    </div>
  </div>
</div>
