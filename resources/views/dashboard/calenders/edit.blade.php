@extends('layouts/layoutMaster')

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



  @if (count($errors) > 0)
    <div class="alert alert-danger">
      <strong>Whoops!</strong> There were some problems with your input.<br><br>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <!-- Users List Table -->
  <div class="card">


    <!-- Offcanvas to add new user -->
    <div class="" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
      <div class="offcanvas-header border-bottom">
        <h6 id="offcanvasAddUserLabel" class="offcanvas-title">Edit calenders</h6>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body mx-0 flex-grow-0">

        <form action='{{route("calenders.update", $obj->id)}}' method='post' enctype='multipart/form-data'>

          @csrf
          @method('PUT')


          <div class="row">
            <div class='mb-3'>
              <label for="defaultFormControlInput" class="form-label">date</label>
              <input type="date" class="form-control"
                     name='date'
                     value="{{ $obj->date }}"
                     id="defaultFormControlInput" aria-describedby="defaultFormControlHelp" />
            </div>

            <div class='mb-3'>
              <label for="defaultFormControlInput" class="form-label">title</label>
              <input type="text" class="form-control"
                     name='title'
                      value='{{ $obj->title }}'
                     id="defaultFormControlInput" aria-describedby="defaultFormControlHelp" />
            </div>

            <div class='mb-3 col-6'>
              <label for="defaultFormControlInput" class="form-label">type</label>
              <input type="text" class="form-control"
                     name='type'
                      value='{{ $obj->type }}'
                     id="defaultFormControlInput" aria-describedby="defaultFormControlHelp" />
            </div>

            <div class='mb-3 col-6'>
              <label for="defaultFormControlInput" class="form-label">amount needed</label>
              <input type="number" class="form-control"
                     name='amount'
                      value='{{ $obj->amount }}'
                     id="defaultFormControlInput" aria-describedby="defaultFormControlHelp" />
            </div>



            <div class='mb-3'>
              <label for="defaultFormControlInput" class="form-label">description</label>
              <input type="text" class="form-control"
                     name='description'
                      value='{{ $obj->description }}'
                     id="defaultFormControlInput" aria-describedby="defaultFormControlHelp" />
            </div>

            <div class='mb-3'>
              <label for="defaultFormControlInput" class="form-label">comment</label>
              <input type="text" class="form-control"
                     name='comment'
                      value='{{ $obj->comment }}'
                     id="defaultFormControlInput" aria-describedby="defaultFormControlHelp" />
            </div>

           <div class='mb-3 col-3'>
             <label for="defaultFormControlInput" class="form-label">status</label>
             <select class="form-select" name="status" id="status" >
               <option value="pending" {{ $obj->status == 'pending' ? 'selected' : '' }}>pending</option>
               <option value="in-progress" {{ $obj->status == 'in-progress' ? 'selected' : '' }}>in-progress</option>
               <option value="completed" {{ $obj->status == 'completed' ? 'selected' : '' }}>completed</option>
             </select>
           </div>

           <div class='mb-3 col-3'>
             <label for="defaultFormControlInput" class="form-label">priority</label>
             <select class="form-select" name="priority" id="priority" >
               <option value="Low" {{ $obj->priority == 'Low' ? 'selected' : '' }}>low</option>
               <option value="Medium" {{ $obj->priority == 'Medium' ? 'selected' : '' }}>medium</option>
               <option value="High" {{ $obj->priority == 'High' ? 'selected' : '' }}>high</option>
             </select>
           </div>

           <div class='mb-3 col-6'>
             <label for="defaultFormControlInput" class="form-label">contact</label>
             <select name='contact_id' class='form-control'>
               <option value=''>--none--</option>
               @foreach($contacts as $c)
                 <option value='{{$c->id}}' {{ $obj->contact_id == $c->id ? 'selected' : '' }}>{{$c->role}} {{$c->name}}</option>
               @endforeach
             </select>
           </div>

          </div>



          <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
          <a href='{{url()->previous()}}' class="btn btn-label-secondary">Cancel</a>

        </form>
      </div>
    </div>
  </div>
@endsection
