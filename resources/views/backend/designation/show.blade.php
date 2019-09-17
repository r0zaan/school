<div class="form-horizontal">
<div class="box-body">

    <div class="form-group">
        <label for="name" class="col-sm-4 control-label">Department Name:</label>
        <div class="col-sm-6 label-top">
            {{$designation->department->name}}
        </div>
    </div>

    <div class="form-group">
        <label for="name" class="col-sm-4 control-label">Designation Name:</label>
        <div class="col-sm-6 label-top">
            {{$department->name}}
        </div>
    </div>

    <div class="form-group">
        <label for="name" class="col-sm-4 control-label">Teacher:</label>
        <div class="col-sm-6 label-top">
            @if($designation->teacher == 0)
                No
            @else
                Yes
            @endif
        </div>
    </div>

</div>
<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
</div>