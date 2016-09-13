<template>
    <div class="row">
        <div class="col-md-12">
            <input v-model="search" class="form-control">
            <a href="#" class="add-product-type"><i class="fa fa-plus-square-o"></i></a>
            <ul class="product-type-list list-group">
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
</template>
<style>
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
            selected_product_type : {}
        }
    },
    computed: {
        
    },
    methods: {
        openModal: function(product_type)
        {
            var vm = this;
            vm.selected_product_type = product_type;

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
                });
                toastr.success(vm.selected_product_type.name+" Saved");
            }, function(dismiss) {
                  // dismiss can be 'cancel', 'overlay', 'close', 'timer'
                  if (dismiss === 'cancel') {
                    swal(
                      'Cancelled',
                      'Your imaginary file is safe :)',
                      'error'
                    );
                  }
            });
            $('.field-select').select2({
              placeholder: 'FieldType'
            });
        }
    },
    ready(){
    }
}
</script>