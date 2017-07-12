<div class="row">
    <div class="col-md-2 col-md-offset-3">
        <div class="form-group">
            <a class="btn btn-default" href="{{ url()->previous() }}"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
    @if (session('status'))
        <div class="col-md-2 col-md-offset-1 alert-flash">
            <div class="alert alert-{{ session()->get('alert-type') }} alert-dismissable">
                {{ session('status') }}
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            </div>
        </div>
    @endif
</div>