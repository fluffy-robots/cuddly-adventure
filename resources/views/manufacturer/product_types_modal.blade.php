<form action="">
    <fieldset>
        <div class="form-group">
            <label class="col-md-4 control-label" for="name">Name</label>
            <div class="col-md-4">
                <input id="name" name="name" type="text" placeholder="placeholder" value="{{$product_type->name}}" class="form-control input-md">
            </div>
        </div>

        <field-types field_types="{{$product_type->fields}}"></field-types>


        {{--@if(count($product_type->fields) < 0)--}}
            {{--<div class="row">--}}
                {{--<div class="col-md-12">--}}
                    {{--<h3 class="field-modal-title">Fields for Product Type</h3>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--@foreach($product_type->fields as $product_field)--}}
            {{--<div class="row">--}}
                {{--<div class="col-md-12">--}}
                    {{--<div class="field-container">--}}
                        {{--<input type="text" class="field-input" name="field_{{$product_field->id}}[]" placeholder="Name" value="{{$product_field->name}}">--}}
                        {{--<select name="field_{{$product_field->id}}[]" class="field-select" id="">--}}
                            {{--@foreach($field_types as $field_type)--}}
                                    {{--<option value="{{$field_type->id}}" @if($product_field->type->id == $field_type->id) selected @endif>{{$field_type->name}}</option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--@endforeach--}}
        {{--@else--}}

        {{--@endif--}}
    </fieldset>
</form>