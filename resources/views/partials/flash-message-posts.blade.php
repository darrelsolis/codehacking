@if (Session::has('deleted_post'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <strong>{{ session('deleted_post') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif (Session::has('created_post'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <strong>{{ session('created_post') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif (Session::has('updated_post'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <strong>{{ session('updated_post') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
