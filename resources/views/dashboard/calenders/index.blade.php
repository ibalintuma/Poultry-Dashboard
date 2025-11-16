<@extends('layouts/layoutMaster')

@section('title', 'calenders')

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

<!-- calenders List Table -->
<div class="card">
  <div class="card-header border-bottom">
    <h5 class="card-title">calenders

        <a href='{{url("calenders/create")}}'
                class='add-new btn btn-primary float-end' >Add</a>

    </h5>

  </div>


  <div class="card-datatable table-responsive">
    <table class="datatables-users table border-top">
      <thead>
        <tr>
          <th>date</th>
          <th>type</th>
          <th>title</th>
          <th>description</th>
          <th>amount</th>
          <th>comment</th>
          <th>status</th>
          <th>priority</th>
          <th>contact</th>
          <th>Action</th>
        </tr>
      </thead>

      @foreach($list as $r)

        <tr
        {{--background color basing on priority--}}
          class="
            @if($r->priority == 'High') table-danger
            @elseif($r->priority == 'Medium') table-warning
            @endif"
        >
          <td class="text-nowrap">
            {{ \Carbon\Carbon::parse($r->date)->format('M d, Y') }}
          </td>
          <td>{{$r->type}}</td>
          <td class="text-nowrap">{{$r->title}}</td>
          <td>
            <div style="width: 300px;">
              {{$r->description}}
            </div>
          </td>
          <td class="text-nowrap">UGX {{number_format($r->amount)}}</td>
          <td>
            <div style="width: 300px;">
            {{$r->comment}}
            </div>
          </td>
          <td>
            <span class="badge bg-dark text-white">{{$r->status}}</span>
          </td>
          <td>{{$r->priority}}</td>
          <td class="text-nowrap">
          @isset( $r->contact )
            {{$r->contact->name}}
          @endisset
          </td>
          <td>
            <div class="row w-100">
              @include("dashboard.components.pato_edit",[ "route" => "calenders.edit","id" => $r->id])
              @include("dashboard.components.pato_delete",[ "route" => "calenders.destroy","id" => $r->id])
            </div>
          </td>

        </tr>

      @endforeach
    </table>
  </div>
  <!-- Offcanvas to add new calenders -->

</div>
@endsection
