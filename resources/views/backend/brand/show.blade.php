<div class="form-horizontal">
<div class="box-body">

    <div class="form-group">
        <label for="name" class="col-sm-4 control-label">Name:</label>
        <div class="col-sm-6 label-top">
            {{$brand->name}}
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-4 control-label">Self Brand:</label>
        <div class="col-sm-6 label-top">
            {{$brand->self_product}}
        </div>
    </div>

    <div class="form-group">
        <label for="name" class="col-sm-4 control-label">Image:</label>
        <div class="col-sm-6 label-top">
           <img src="{{url($brand->image)}}" height="100px"/>
        </div>
    </div>

</div>
<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
</div>