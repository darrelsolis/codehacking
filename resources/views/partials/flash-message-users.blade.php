@if (Session::has('deleted_user'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <strong>{{ session('deleted_user') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif (Session::has('created_user'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <strong>{{ session('created_user') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif (Session::has('updated_user'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <strong>{{ session('updated_user') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
