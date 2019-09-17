<div class="box-body">
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Name:<span class=help-block"
                                                                    style="color:red;">*</span></label>
        <div class="col-sm-4">
            {{ Form::text('name',null,['class'=>'form-control','placeholder'=>'Enter Product Name']) }}
            <span class="error-message"></span>
        </div>
        <label for="name" class="col-sm-2 control-label">Model Number:<span class=help-block"
                                                                            style="color:red;">*</span></label>
        <div class="col-sm-4">
            {{ Form::text('model_number',null,['class'=>'form-control','placeholder'=>'Enter Model Number']) }}
            <span class="error-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Brand:<span class=help-block"
                                                                     style="color:red;">*</span></label>
        <div class="col-sm-4">
            {{ Form::select('brand_id',$brands,null,['class'=>'form-control','placeholder'=>'Select One Brand']) }}
            <span class="error-message"></span>
        </div>
        <label for="name" class="col-sm-2 control-label">Category:<span class=help-block"
                                                                        style="color:red;">*</span></label>
        <div class="col-sm-4">
            {{ Form::select('group_id',$groups,null,['class'=>'form-control','placeholder'=>'Select One Category']) }}
            <span class="error-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Price:<span class=help-block"
                                                                     style="color:red;">*</span></label>
        <div class="col-sm-4">
            {{ Form::number('price',null,['class'=>'form-control','placeholder'=>'Enter price']) }}
            <span class="error-message"></span>
        </div>
        <label for="name" class="col-sm-2 control-label">Discount(%):<span class=help-block" style="color:red;">*</span></label>
        <div class="col-sm-4">
            {{ Form::number('discount_percentage',null,['class'=>'form-control','placeholder'=>'Enter Discount in percentage']) }}
            <span class="error-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Description:<span class=help-block" style="color:red;">*</span></label>
        <div class="col-sm-10">
            {{ Form::textarea('description',null,['class'=>'form-control','placeholder'=>'Enter Description of Product']) }}
            <span class="error-message"></span>
        </div>
    </div>
    @if(isset($product))
        @foreach($product->colorImages()->get() as $key => $image)
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Color Name:<span class=help-block"
                                                                                  style="color:red;">*</span></label>
                <div class="col-sm-1">
                    {{ Form::text('color_name[]',$image['color_name'],['class'=>'form-control','placeholder'=>'','required']) }}
                    <span class="error-message"></span>
                </div>
                <label for="name" class="col-sm-2 control-label">Color Code:<span class=help-block"
                                                                                  style="color:red;">*</span></label>
                <div class="col-sm-1">
                    <div class="my-colorpicker2">
                        {{ Form::text('color_code[]',$image['color_code'],['class'=>'form-control ','placeholder'=>'#fffff','required']) }}
                        <div class="input-group-addon ">
                            <i></i>
                        </div>
                    </div>
                </div>
                <label for="name" class="col-sm-1 control-label">Image:<a href="{{url($image->image)}}" target="_blank">(View)</a></label>
                <div class="col-sm-2">
                    {{ Form::file('image[]',['class'=>'form-control ']) }}
                </div>
                <label for="name" class="col-sm-1 control-label">Quantity:<span class=help-block"
                                                                                style="color:red;">*</span></label>
                <div class="col-sm-1">
                    {{ Form::text('quantity[]',$image['quantity'],['class'=>'form-control ','placeholder'=>'','required']) }}
                </div>
                @if($key != 0)
                    <div class="col-sm-1">
                        <button type="button" class="btn btn-danger delete-color" data-url="{{ route('products.colorImageDestroy', array($image->id)) }}"><i class="fa fa-trash"></i></button>
                    </div>
                @endif

            </div>
        @endforeach
    @else
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Color Name:<span class=help-block"
                                                                              style="color:red;">*</span></label>
            <div class="col-sm-1">
                {{ Form::text('color_name[]',null,['class'=>'form-control','placeholder'=>'','required']) }}
                <span class="error-message"></span>
            </div>
            <label for="name" class="col-sm-2 control-label">Color Code:<span class=help-block"
                                                                              style="color:red;">*</span></label>
            <div class="col-sm-1">
                <div class="my-colorpicker2">
                    {{ Form::text('color_code[]',null,['class'=>'form-control ','placeholder'=>'#fffff','required']) }}
                    <div class="input-group-addon ">
                        <i></i>
                    </div>
                </div>
            </div>
            <label for="name" class="col-sm-1 control-label">Image:<span class=help-block"
                                                                         style="color:red;">*</span></label>
            <div class="col-sm-2">
                {{ Form::file('image[]',['class'=>'form-control ','required']) }}
            </div>
            <label for="name" class="col-sm-1 control-label">Quantity:<span class=help-block"
                                                                            style="color:red;">*</span></label>
            <div class="col-sm-1">
                {{ Form::text('quantity[]',null,['class'=>'form-control ','placeholder'=>'','required']) }}
            </div>
        </div>
    @endif

    <div class="add-color">

    </div>
    <div class="form-group">
        <label for="name" class="col-sm-10 control-label"></label>
        <div class="col-sm-2">
            <button type="button" class="btn btn-primary add-button"><i class="fa fa-plus"></i> Add</button>
        </div>
    </div>
</div>