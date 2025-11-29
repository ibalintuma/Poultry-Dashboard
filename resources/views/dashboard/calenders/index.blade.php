@extends('layouts/layoutMaster')

@section('title', 'My Tasks')

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

@section('content')

  @php
    $today = now()->toDateString();

    $overdueCount = $list->filter(function($item) use ($today) {
      return $item->date < $today && $item->status != 'Completed';
    })->count();

    $todayCount = $list->filter(function($item) use ($today) {
      return $item->date == $today;
    })->count();

    $upcomingCount = $list->filter(function($item) use ($today) {
      return $item->date > $today && $item->status != 'Completed';
    })->count();

    $completedCount = $list->where('status', 'Completed')->count();
  @endphp

    <!-- Simple top summary -->
  <div class="row mb-4">
    <div class="col-sm-6 col-lg-3 mb-3">
      <div class="card h-100">
        <div class="card-body d-flex align-items-center">
          <div class="avatar avatar-lg flex-shrink-0 me-3">
            <span class="avatar-initial rounded bg-label-danger">
              <i class="bx bx-error-circle"></i>
            </span>
          </div>
          <div>
            <div class="small text-muted">Late tasks</div>
            <h4 class="mb-0 {{ $overdueCount > 0 ? 'text-danger' : 'text-success' }}">{{ $overdueCount }}</h4>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-lg-3 mb-3">
      <div class="card h-100">
        <div class="card-body d-flex align-items-center">
          <div class="avatar avatar-lg flex-shrink-0 me-3">
            <span class="avatar-initial rounded bg-label-primary">
              <i class="bx bx-calendar-check"></i>
            </span>
          </div>
          <div>
            <div class="small text-muted">Today</div>
            <h4 class="mb-0">{{ $todayCount }}</h4>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-lg-3 mb-3">
      <div class="card h-100">
        <div class="card-body d-flex align-items-center">
          <div class="avatar avatar-lg flex-shrink-0 me-3">
            <span class="avatar-initial rounded bg-label-warning">
              <i class="bx bx-time-five"></i>
            </span>
          </div>
          <div>
            <div class="small text-muted">Coming days</div>
            <h4 class="mb-0">{{ $upcomingCount }}</h4>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-lg-3 mb-3">
      <div class="card h-100">
        <div class="card-body d-flex align-items-center">
          <div class="avatar avatar-lg flex-shrink-0 me-3">
            <span class="avatar-initial rounded bg-label-success">
              <i class="bx bx-check-circle"></i>
            </span>
          </div>
          <div>
            <div class="small text-muted">Done</div>
            <h4 class="mb-0">{{ $completedCount }}</h4>
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

  <!-- Short alert messages -->
  @if($overdueCount > 0)
    <div class="alert alert-danger alert-dismissible mb-3" role="alert">
      <strong>Attention:</strong> {{ $overdueCount }} task(s) are late. Please check them.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <!-- Header + simple filters -->
  <div class="card">
    <div class="card-header border-bottom">
      <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h5 class="card-title mb-0">
          <i class="bx bx-calendar me-2"></i>My Farm Tasks
        </h5>
        <div class="d-flex gap-2 flex-wrap">
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-sm btn-outline-secondary filter-btn active" data-filter="all">
              All
            </button>
            <button type="button" class="btn btn-sm btn-outline-primary filter-btn" data-filter="today">
              Today
            </button>
            <button type="button" class="btn btn-sm btn-outline-warning filter-btn" data-filter="upcoming">
              Later
            </button>
            <button type="button" class="btn btn-sm btn-outline-success filter-btn" data-filter="completed">
              Done
            </button>
          </div>
          <a href='{{url("calenders/create")}}' class='btn btn-sm btn-primary'>
            <i class="bx bx-plus me-1"></i> New task
          </a>
        </div>
      </div>
    </div>

    <div class="card-body p-0">
      <!-- Simple task list -->
      <div class="task-list">
        @forelse($list->sortBy('date') as $r)
          @php
            $isOverdue = $r->date < $today && $r->status != 'Completed';
            $isToday = $r->date == $today;
            $isUpcoming = $r->date > $today;
            $isCompleted = $r->status == 'Completed';

            $dateObj = \Carbon\Carbon::parse($r->date);
            $daysUntil = now()->startOfDay()->diffInDays($dateObj, false);

            if ($isCompleted) {
              $borderClass = 'border-start border-success border-4';
              $filterClass = 'completed';
            } elseif ($isOverdue) {
              $borderClass = 'border-start border-danger border-4';
              $filterClass = 'overdue';
            } elseif ($isToday) {
              $borderClass = 'border-start border-primary border-4';
              $filterClass = 'today';
            } else {
              $borderClass = 'border-start border-warning border-4';
              $filterClass = 'upcoming';
            }
          @endphp

          <div class="task-item p-3 border-bottom {{ $isCompleted ? 'bg-light' : '' }}"
               data-filter-type="{{ $filterClass }}">
            <div class="d-flex align-items-start justify-content-between gap-3">



              <!-- Date -->
              <div class="text-center" style="min-width: 60px;">
                <div class=" {{ $isOverdue ? 'bg-danger' : ($isToday ? 'bg-primary' : ($isCompleted ? 'bg-success' : 'bg-warning')) }} text-white rounded">
                  <span class="avatar-initial rounded">
                    {{ $dateObj->format('d') }}
                  </span>
                </div>
                <small class="text-black d-block mt-1">{{ $dateObj->format('M') }}</small>
              </div>


              <!-- Main info -->
              <div class="flex-grow-1">
                <div class="d-flex justify-content-between align-items-start gap-2">
                  <div>
                    <h6 class="mb-1 {{ $isCompleted ?  'text-decoration-line-through text-muted' : '' }}">
                      {{ $r->title ?: 'No title' }}
                    </h6>

                    @if($r->description)
                      <p class="text-muted mb-1 small {{ $isCompleted ? 'text-decoration-line-through' : '' }}">
                        {{ Str::limit($r->description, 80) }}
                      </p>
                    @endif

                    <div class="d-flex flex-wrap gap-2 small">

                        <span class="text-muted">
                          <i class="bx bx-stats me-1"></i>{{ strtoupper($r->status) }}
                        </span>

                      {{-- When --}}
                      <span class="{{ $isOverdue ? 'text-danger' : ($isToday ? 'text-primary' : 'text-muted') }}">
                        <i class="bx bx-time-five me-1"></i>
                        @if($isOverdue)
                          Late ({{ abs($daysUntil) }} day(s) ago)
                        @elseif($isToday)
                          Today
                        @elseif($daysUntil == 1)
                          Tomorrow
                        @elseif($daysUntil > 1)
                          In {{ $daysUntil }} days
                        @else
                          {{ $dateObj->format('d M Y') }}
                        @endif
                      </span>

                      {{-- Who --}}
                      @isset($r->contact)
                        <span class="text-muted">
                          <i class="bx bx-user me-1"></i>{{ $r->contact->name }}
                        </span>
                      @endisset

                      {{-- Money --}}
                      @if($r->amount > 0)
                        <span class="text-success">
                          <i class="bx bx-wallet me-1"></i>UGX {{ number_format($r->amount) }}
                        </span>
                      @endif
                    </div>
                  </div>


                  <!-- Status + actions -->
                  <div class="text-end">
                    {{-- Simple status text --}}


                    <div class="mt-2">
                      <a href="{{ route('calenders.edit', $r->id) }}" class="btn btn-outline-secondary mb-1">
                        Edit
                      </a>
                      @if($r->status != 'Completed')
                        <a href="{{ route('calenders.complete', $r->id) }}" class="btn btn-success mb-1">
                          Done
                        </a>
                      @endif
                      <form action="{{ route('calenders.destroy', $r->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger mb-1"
                                onclick="return confirm('Delete this task?')">
                          Delete
                        </button>
                      </form>
                    </div>
                  </div>
                </div>

              </div>

              <div style="width: 150px;" class="text-center">
                @if($r->status == 'Completed')
                  <span class="badge bg-success">Done</span>
                @elseif($r->status == 'In Progress')
                  <span class="badge bg-info">Doing</span>
                @else
                  <span class="badge bg-warning">Not done</span>
                @endif
              </div>

            </div>
          </div>
        @empty
          <div class="text-center py-5">
            <div class="avatar avatar-lg mb-3">
              <span class="avatar-initial rounded-circle bg-label-secondary">
                <i class="bx bx-calendar-x fs-3"></i>
              </span>
            </div>
            <h6 class="mb-1">No tasks yet</h6>
            <p class="text-muted mb-3">You have not added any work or reminder.</p>
            <a href='{{url("calenders/create")}}' class='btn btn-primary'>
              <i class="bx bx-plus me-1"></i> Add a task
            </a>
          </div>
        @endforelse
      </div>
    </div>
  </div>

@endsection

@section('page-script')
  <script>
    // Filter buttons: All / Today / Later / Done
    document.querySelectorAll('.filter-btn').forEach(function(btn) {
      btn.addEventListener('click', function() {
        document.querySelectorAll('.filter-btn').forEach(function(b) {
          b.classList.remove('active');
        });
        this.classList.add('active');

        var filter = this.getAttribute('data-filter');
        document.querySelectorAll('.task-item').forEach(function(item) {
          if (filter === 'all') {
            item.style.display = 'block';
          } else if (item.getAttribute('data-filter-type') === filter) {
            item.style.display = 'block';
          } else {
            item.style.display = 'none';
          }
        });
      });
    });
  </script>
@endsection
