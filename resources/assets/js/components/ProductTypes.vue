<template>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="product-type-control-container">
                        <button
                                @click="editProductType()"
                                class="btn btn-default product-type-control"
                        ><i class="fa fa-plus-square-o"></i> Add Product Type</button>
                        <input v-model="search" placeholder="Search" class="form-control product-type-control-container">
                        <button @click="show = 'grid'" v-bind:class="{ 'btn-active': show == 'grid'}" class="btn btn-default product-type-control"><i class="fa fa-th-list"></i> Grid</button>
                        <button @click="show = 'list'" v-bind:class="{ 'btn-active': show == 'list'}" class="btn btn-default product-type-control"><i class="fa fa-th"></i> List</button>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div
                                class="upsert-form"
                                v-show="show_upsert"
                            >
                                <form action="">
                                    <fieldset>
                                        <legend>{{ is_new_product_type ? 'Create Product Type' : 'Update Product Type '+selected_product_type.name}}</legend>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="name">Name</label>
                                            <div class="col-md-4">
                                                <input id="name" name="name" type="text" placeholder="Name" v-model="selected_product_type.name" class="form-control input-md">
                                            </div>
                                        </div>
                                        <field-types
                                                :product_type_fields.sync="selected_product_type.fields"
                                                :field_types="field_types"
                                        ></field-types>
                                    </fieldset>
                                </form>
                                <div class="form-group">
                                    <button
                                            @click="upsertProductType"
                                            class="btn btn-success"
                                    >Save</button>
                                    <button
                                            @click="show_upsert = false"
                                            class="btn btn-warning"
                                    >Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        <div
                        v-if="show == 'list'"
                        class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th style="width: 150px;">Controls</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr
                                v-for="product_type in product_types | filterBy search"
                            >
                                <th scope="row">{{ product_type.id }}</th>
                                <td>{{ product_type.name }}</td>
                                <td class="text-right">
                                    <button
                                            @click="editProductType(product_type)"
                                            class="btn btn-warning"
                                    ><i class="fa fa-pencil-square-o"></i> Edit</button>
                                    <button
                                        @click="deleteProductType(product_type)"
                                        class="btn btn-danger"
                                    ><i class="fa fa-trash-o"></i> Delete</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                        <ul class="product-type-list list-group" v-if="show == 'grid'">
                            <li
                                v-for="product_type in product_types | filterBy search"
                                class="product-type-list-item list-group-item"
                                @click="openModal(product_type)"
                            >
                                {{ product_type.name }}
                            </li>
                        </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
    .select2-selection {
        height: 32px !important;
    }
    .panel-body {
        background: white;
    }
    .product-type-control-container{
        display: flex;
    }
    .add-product-type {
        color: #1ab394;
        font-size: 40px;
    }
    .product-type-list-item {
        width: 25%;
    }
    .product-type-list {
        display: flex;
        flex-wrap: wrap;
    }
    .select2-container{
        z-index: 2000;
        min-width: 50%;
    }
    .field-container{
        display:flex;
        padding-top: 20px;
    }
    .field-input,.field-select{
        flex-grow:1;
        padding: 5px;
        border: 1px solid #e7eaec;
        border-radius: 0;
    }
    .field-select{
        min-width: 50px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 5px;
    }
    .select2-container--default .select2-selection--multiple, .select2-container--default .select2-selection--single{
        border-radius: 0;
        border: 1px solid #e7eaec;
    }
    .field-modal-title {
        padding: 0;
        margin: 20px 0 0px 0;
        font-size: 20px;
    }
    .upsert-form{
        padding: 15px;
        padding-bottom: 50px;
    }
</style>
<script>
export default
{
    props:{
        product_types: {
            coerce: function (val) {
                return JSON.parse(val);
            }
        },
        field_types: {
            coerce: function(val){
                return JSON.parse(val);
            }
        }
    },
    data(){
        return{
            search : "",
            is_new_product_type: false,
            show: 'list',
            show_upsert: false,
            selected_product_type: {}
        }
    },
    computed: {
        
    },
    methods: {
        upsertProductType: function(event)
        {
            event.preventDefault();
            let vm = this;
            vm.$http.post('/product-types',vm.selected_product_type).then(function(){
                vm.refreshProductTypes();
                toastr.success(vm.selected_product_type.name+" Saved");
                vm.show_upsert = false;
            });
        },
        deleteProductType: function (product_type)
        {
            let vm = this;
            let data = {
                _method : "DELETE"
            };
            vm.$http.post('/product-types/'+product_type.id,data)
            .then(function(){
                toastr.error(product_type.name+" Deleted");
                vm.refreshProductTypes();
            });  
        },
        editProductType: function (product_type){
            let vm = this;
            if(product_type == undefined)
            {
                product_type = {
                    id : 0,
                    name : '',
                    fields: []
                }
            }
            vm.show_upsert = true;
            vm.selected_product_type = product_type;
        },
        refreshProductTypes: function(){
            let vm = this;

            vm.$http.get('/product-types/getProductTypes')
            .then(function(response){
                vm.$set("product_types", response.data);
            });
        }
    },
    ready(){
        let vm = this;
    }
}
</script>