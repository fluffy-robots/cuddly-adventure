<template>
    <div class="product-fields" v-if="show_fields">
        <div
            class="fields form-group"
            v-for="(index, field) in product.type.fields"
        >
            <label class="col-md-4 control-label">
                {{ field.name }}
                {{ field.type.name }}
                {{ index }}
            </label>
            <div class="col-md-6 text" v-if="field.type.name == 'Text'">
                <input name="{{field.name}}" class="form-control" v-model="product.info[index+field.type.name]">
            </div>
            <div class="col-md-6 description" v-if="field.type.name == 'Description'">
                <textarea name="{{field.name}}" class="form-control" v-model="product.info[index+field.type.name]"></textarea>
            </div>
            <div class="col-md-6 weight" v-if="field.type.name == 'Weight'">
                <input name="{{field.name}}" class="form-control" v-model="product.info[index+field.type.name+'_value']">
                <select class="form-control" v-model="product.info[index+field.type.name+'_option']">
                    <option value="1">g</option>
                    <option value="2">kg</option>
                    <option value="3">ton</option>
                </select>
            </div>
        </div>
    </div>
</template>
<style>
    .product-fields{
        margin-left: -15px;
        margin-right: -15px;
        display: flex;
        flex-direction: column;
    }
</style>
<script>
export default
{
    props:{
        product: {
            type: Object,
            twoWay: true
        }
    },
    data(){
        return{
            
        }
    },
    computed: {
        show_fields: function(){
            let vm = this;
            return vm.$get('product.type') != undefined;
        }
    },
    methods: {
    },
    ready(){
    }
}
</script>