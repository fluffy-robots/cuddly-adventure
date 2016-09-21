<template>
    <div class="row">
        <div class="col-md-12">
            <div class="field-container">
                <input type="text" class="field-input" name="" placeholder="Name" value="">
                <select name="" class="field-select" id="">
                    <option value=""></option>
                </select>
            </div>
        </div>
    </div>
</template>
<style>

</style>
<script>
export default
{
    props:{
        field_types: {
            coerce: function (val) {
                return JSON.parse(val);
            }
        }
    },
    data(){
        return{
            
        }
    },
    computed: {
        
    },
    methods: {
        
    },
    ready(){
        $('.field-select').select2({
          placeholder: 'FieldType'
        });
    }
}
</script>