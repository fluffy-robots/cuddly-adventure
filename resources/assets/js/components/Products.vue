<template>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="product-control-container">
                        <button
                                @click="editProduct()"
                                class="btn btn-default product-control"
                        ><i class="fa fa-plus-square-o"></i> Add Product </button>
                        <input v-model="search" placeholder="Search" class="form-control product-control-container">
                        <button @click="show = 'grid'" v-bind:class="{ 'btn-active': show == 'grid'}" class="btn btn-default product-control"><i class="fa fa-th-list"></i> Grid</button>
                        <button @click="show = 'list'" v-bind:class="{ 'btn-active': show == 'list'}" class="btn btn-default product-control"><i class="fa fa-th"></i> List</button>
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
                                        <legend>{{ is_new_product ? 'Create Product ' : 'Update Product  '+selected_product.name}}</legend>
                                        <div class="row">
                                            <div class="form-group" v-bind:class="{ 'has-error' : validate_selected_product_name }">
                                                <label class="col-md-4 control-label" for="name">Name</label>
                                                <div class="col-md-6">
                                                    <input id="name" name="name" type="text" placeholder="Name" v-model="selected_product.name" class="form-control input-md" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label product-type-title" for="name">Product Type</label>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <select name="type_id" id="product_type" class="product-type-select form-control" v-model="selected_product.type_id">
                                                                <option
                                                                    v-for="product_type in product_types"
                                                                    value="{{product_type.id}}"
                                                                >{{ product_type.name }}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <product-fields :product.sync="selected_product"></product-fields>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Fields -->
                                    </fieldset>
                                </form>
                                <div class="form-group">
                                    <button
                                            @click="upsertProduct"
                                            class="btn btn-success"
                                    >Save</button>
                                    <button
                                            @click="undoProduct"
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
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th style="width: 150px;">Controls</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr
                                v-for="product in products | filterBy search"
                            >
                                <th scope="row">{{ product.id }}</th>
                                <td>{{ product.name }}</td>
                                <td style="width: 105px;">{{ product.created_at }}</td>
                                <td style="width: 105px;">{{ product.updated_at }}</td>
                                <td class="text-right">
                                    <button
                                            @click="editProduct(product)"
                                            class="btn btn-warning"
                                    ><i class="fa fa-pencil-square-o"></i> Edit</button>
                                    <button
                                        @click="deleteProduct(product)"
                                        class="btn btn-danger"
                                    ><i class="fa fa-trash-o"></i> Delete</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                        <ul class="product-list list-group" v-if="show == 'grid'">
                            <li
                                v-for="product in products | filterBy search"
                                class="product-list-item list-group-item"
                                @click="openModal(product)"
                            >
                                {{ product.name }}
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

    .product-type-title{
        padding-bottom: 20px;
        padding-top: 20px;
    }
    .product-type-select{
        position: absolute;
        top: -44px;
        left: 69.5%;
        width: 94.2%;
    }
    .select2-selection {
        height: 32px !important;
    }
    .panel-body {
        background: white;
    }
    .product-control-container{
        display: flex;
    }
    .add-product {
        color: #1ab394;
        font-size: 40px;
    }
    .product-list-item {
        width: 25%;
    }
    .product-list {
        display: flex;
        flex-wrap: wrap;
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
        products: {
            coerce: function (val) {
                return JSON.parse(val);
            }
        },
        product_types: {
            coerce: function (val) {
                return JSON.parse(val);
            }
        }
    },
    data(){
        return{
            search : "",
            is_new_product: false,
            show: 'list',
            show_upsert: false,
            step_1: false,
            step_2: false,
            selected_product: {
                type: {
                    fields: []
                },
                info: {}
            },
            validate_selected_product_name : false
        }
    },
    computed: {
    },
    methods: {
        upsertProduct: function(event)
        {
            event.preventDefault();
            let vm = this;
            vm.$http.post('/products',vm.selected_product).then(function(){
                vm.refreshProducts();
                toastr.success(vm.selected_product.name+" Saved");
                vm.show_upsert = false;
                vm.validate_selected_product_name = false;
            }, function(response){
                toastr.error("A 'Name' is Required for a Product");
                vm.validate_selected_product_name = true;
            });
        },
        deleteProduct: function (product)
        {
            let vm = this;
            let data = {
                _method : "DELETE"
            };
            vm.$http.post('/products/'+product.id,data)
            .then(function(){
                toastr.error(product.name+" Deleted");
                vm.refreshProducts();
            });
        },
        editProduct: function (product){
            let vm = this;
            if(product == undefined)
            {
                vm.selected_product =
                {
                    id: 0,
                    type: {
                        fields: []
                    },
                    info: {}
                }
            }else{
                vm.selected_product = product;
            }
            vm.show_upsert = true;
        },
        undoProduct: function(){
            let vm = this;
            vm.show_upsert = false;
            toastr.info("Nothing was Changed");
            vm.refreshProducts();
        },
        refreshProducts: function(){
            let vm = this;

            vm.$http.get('/products/getProducts')
            .then(function(response){
                vm.$set("products", response.data);
            });
        }
    },
    ready(){
        let vm = this;
        vm.$watch('selected_product.type_id', function (type_id) {
            vm.selected_product.type = vm.product_types[type_id - 1];
        })
    }
}
</script>