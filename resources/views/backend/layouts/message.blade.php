@if(count($errors)>0)
    <div class="alert alert-danger">
        * Check if your data is incomplete/not valid.
    @foreach($errors->all() as $error)
            {{$error}} <br/>
    @endforeach
    </div>

@endif

@if(Session::has('success'))
    <div class="content_top">
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ session('success') }}
        </div>
    </div>
@endif

@if(session('error'))
    <div class="content_top">
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{session('error')}}
        </div>
    </div>
@endif
