<div class="col-6 pt-3">
  <form action="{{ route($route, $id) }}" method="POST">
    @method('DELETE')
    @csrf
    <button class="btn btn-sm btn-outline-danger" >
      <i class="bx bx-trash"></i>
    </button>
  </form>
</div>
