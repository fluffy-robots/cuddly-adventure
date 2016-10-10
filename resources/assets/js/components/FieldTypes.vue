<template>
    <div class="row"
        v-for="product_type_field in product_type_fields">
        <div class="col-md-11">
            <div class="field-container">
                <input type="text" class="field-input" name="" placeholder="Name" v-model="product_type_field.name">
                <select
                        name=""
                        class="field-select"
                        v-model="product_type_field.field_type_id">
                    <option
                            v-for="field_type in field_types"
                            value="{{field_type.id}}"
                    >
                        {{field_type.name}}
                    </option>
                </select>
            </div>
        </div>
        <div class="col-md-1">
            <a
                @click="removeProductFieldType(product_type_field)"
                class="field_type_delete"
            >
                <i class="fa fa-trash-o"></i>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button
                class="btn btn-default"
                @click="addProductFieldType"
            >Add Field</button>
        </div>
    </div>
</template>
<style>
    .field_type_delete{
        color: red;
        position: absolute;
        top: 15px;
        font-size: 23px;
    }
    .field_type_delete:hover{
        color: black;
    }

</style>
<script>
export default
{
    props:{
        field_types: {
            type: Array
        },
        product_type_fields: {
            type: Array,
            twoWay: true
        }
    },
    data(){
        return{
            
        }
    },
    computed: {
        
    },
    methods: {
        addProductFieldType: function(event)
        {
            event.preventDefault();
            let vm = this;
            let product_type_field = {
                id: 0,
                name: '',
                field_type_id: 1
            };
            vm.product_type_fields.push(product_type_field);
            let c = 1;
            vm.product_type_fields.forEach(function(product_type){
                product_type.order = c;
                c++;
            });
        },
        removeProductFieldType: function(product_type_field)
        {
            let vm = this;
            vm.product_type_fields = vm.product_type_fields.filter(function(element) {
                if(element.id == 0)
                {
                    return element.order !== product_type_field.order;
                }else{
                    return element.id !== product_type_field.id;
                }
            });
        }
    },
    ready(){
    }
}
</script>