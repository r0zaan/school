<div class="form-horizontal">
<div class="box-body">

    <div class="form-group">
        <label for="name" class="col-sm-4 control-label">Name:</label>
        <div class="col-sm-6 label-top">
            {{$session->name}}
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-4 control-label">Start Date:</label>
        <div class="col-sm-6 label-top">
            {{$session->start_date}}
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-4 control-label">End Date:</label>
        <div class="col-sm-6 label-top">
            {{$session->end_date}}
        </div>
    </div>

</div>
<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
</div>