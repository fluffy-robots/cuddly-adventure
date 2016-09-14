<template>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="product-type-control-container">
                        <button
                                @click="openModal(emptyModal)"
                                class="btn btn-default product-type-control"
                        ><i class="fa fa-plus-square-o"></i> Add Product Type</button>
                        <input v-model="search" placeholder="Search" class="form-control product-type-control-container">
                        <button @click="show = 'grid'" v-bind:class="{ 'btn-active': show == 'grid'}" class="btn btn-default product-type-control"><i class="fa fa-th-list"></i> Grid</button>
                        <button @click="show = 'list'" v-bind:class="{ 'btn-active': show == 'list'}" class="btn btn-default product-type-control"><i class="fa fa-th"></i> List</button>
                    </div>
                </div>
                <div class="panel-body">
                    <div
                        v-if="show == 'list'"
                        class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Controls</th>
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
                                            @click="openModal(product_type)"
                                            class="btn btn-warning"
                                    ><i class="fa fa-pencil-square-o"></i> Edit</button>
                                    <button class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</button>
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
</template>
<style>
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
    .select2-selection--single{
        padding: 5px;
        height: 2em !important;
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
</style>
<script>
export default
{
    props:{
        product_types: {
            coerce: function (val) {
                return JSON.parse(val);
            }
        }
    },
    data(){
        return{
            search : "",
            selected_product_type : {},
            show: 'list'
        }
    },
    computed: {
        
    },
    methods: {
        openModal: function(product_type)
        {
            var vm = this;
            vm.selected_product_type = product_type;

            // Get Call
//            vm.$http.get('url')
//                    .then(function(response){
//
//            });

            swal({
                title: vm.selected_product_type.name,
                html: vm.selected_product_type.html,
                showCancelButton: true,
                confirmButtonColor: '#1ab394',
                reverseButtons: true,
                confirmButtonText: 'Save',
                showLoaderOnConfirm: true,
                allowOutsideClick: false
            }).then(function(result) {
                console.log(result);
                swal({
                    type: 'success',
                    title: 'Product Type Saved!',
                    timer: 1000,
                    showConfirmButton: false
                }).done();
                toastr.success(vm.selected_product_type.name+" Saved");
            }, function(dismiss) {
                // dismiss can be 'cancel', 'overlay', 'close', 'timer'
                if (dismiss === 'cancel') {
                    swal(
                        {
                            type: 'error',
                            title: 'Cancelled',
                            timer: 1000,
                            showConfirmButton: false
                        }
                    ).done();
                    toastr.info(vm.selected_product_type.name+" wasn't Changed");
                }
            }).done();
            $('.field-select').select2({
              placeholder: 'FieldType'
            });
        }
    },
    ready(){
    }
}
</script>