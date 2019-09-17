<div class="form-horizontal">
<div class="box-body">

    <div class="form-group">
        <label for="name" class="col-sm-4 control-label">Class:</label>
        <div class="col-sm-6 label-top">
            {{$section->classroom->name}}
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-4 control-label">Name:</label>
        <div class="col-sm-6 label-top">
            {{$section->name}}
        </div>
    </div>

</div>
<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
</div>