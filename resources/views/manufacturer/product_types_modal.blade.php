<form action="">
    <fieldset>
        <div class="form-group">
            <label class="col-md-4 control-label" for="name">Name</label>
            <div class="col-md-4">
                <input id="name" name="name" type="text" placeholder="placeholder" value="{{$product_type->name}}" class="form-control input-md">
            </div>
        </div>
        @foreach($product_type->fields as $product_field)
        <div class="row">
            <div class="col-md-12">
                <div class="field-container">
                    <input type="text" class="field-input" name="field_1[]" placeholder="Name" value="{{$product_field->name}}">
                    <select name="field_1[]" class="field-select" id="">
                        @foreach($fields as $field)
                            {{-- If Options ...--}}
                            @if($product_field->id == $field->id)
                                <option value="{{$field->id}}" selected>{{$field->type}}</option>
                            @else
                                <option value="{{$field->id}}">{{$field->type}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        @endforeach
    </fieldset>
</form>