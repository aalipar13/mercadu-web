@if (session('status'))
    <div class="row alert-flash">
        <div class="col-md-3 col-md-offset-7">
            <div class="alert alert-{{ session()->get('alert-type') }} alert-dismissable">
                {{ session('status') }}
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            </div>
        </div>
    </div>
@endif