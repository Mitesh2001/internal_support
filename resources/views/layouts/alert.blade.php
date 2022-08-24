
@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
      <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
      <span class="alert-inner--text"><strong>Success!</strong> {{ $message }}</span>
      <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
      </button>
</div>
@endif

@if ($message = Session::get('error'))
<div class="col-sm-12 p-0">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>{{ $message }}</strong>
    </div>
</div>
@endif
