<template>
    <div class="row-">
        <div class="col-md-4">
            <div class="ibox">
                <div class="ibox-content">
                    <input class="search-bar" placeholder="Søg Her" v-model="query">
                    <a
                        @click="addElement"
                    >
                        <i class="fa fa-plus-circle"></i>Tilføj
                    </a>
                    <img v-show="loading" src="/images/ring.svg" class="loading">
                    <ul class="list-group">
                        <li
                            class="list-group-item"
                            v-for="element in elements | filterBy query"
                            @click="viewElement(element)"
                        >
                            <p>{{ element.name }}</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div
                v-show="showSidebar"
                class="well">
                <div class="row">
                    <div class="col-md-12">
                        <h1><small>Preview</small></h1>
                        <div class="preview">
                            {{{ preview }}}
                        </div>
                        <hr>
                    </div>


                </div>
                <div class="row">
                    <div class="col-md-12">
                            <!-- Form Name -->
                            <legend>{{ (selectedElement.name != "" ) ? selectedElement.name : "Nyt Element" }}</legend>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="name"></label>
                                <div class="col-md-8">
                                    <input id="name" name="name" type="text" v-model="selectedElement.name" placeholder="Navn" class="form-control input-md" required="">
                                </div>
                            </div>

                            <!-- Textarea -->
                            <div class="form-group">
                                <div class="col-md-12">
                                    <editor></editor>
                                </div>
                            </div>

                            <!-- Button -->
                            <div class="form-group">
                                <div class="col-md-12">
                                    <button id="" name="" @click="saveElement" class="btn btn-success">Save</button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
.loading{
    height:20px;
    background: red;
}
</style>
<script>
export default
{
    props:{
        elements: {
            coerce: function (val) {
                return JSON.parse(val);
            }
        }
    },
    data(){
        return{
            query: '',
            loading: false,
            showSidebar: false,
            selectedElement: {},
            preview: ""
        }
    },
    events: {
        'update-editor': function (content)
        {
            var vm = this;
            var selectedElement = vm.$get('selectedElement');
            vm.$nextTick(function () {
                selectedElement.code = content;
                vm.preview = content;
            });
        }


    },
    methods: {
        viewElement(element){
            var vm = this;
            vm.$set('showSidebar', true);
            if(element.id != undefined)
            {
                vm.$http.post(
                        '/api/ui-elements/getElement',
                        element,
                        {
                            before(request){
                                vm.loading = true;
                            }
                        }
                )
                        .then(function(response){
                            element.code = response.data.code;
                            vm.$set('selectedElement',element);
                            vm.loading = false;
                            vm.preview = vm.selectedElement.code;
                            vm.$broadcast('update-editor', vm.selectedElement.code);
                        });
            }else{
                vm.$set('selectedElement',element);
            }
        },
        addElement(){
            var vm = this;
            var element = {
                id : undefined,
                name : "",
                file_path : ""
            };
            vm.viewElement(element);
        },
        saveElement(){
            var vm = this;
            var data = {
                id : vm.selectedElement.id,
                name : vm.selectedElement.name,
                file_path : "",
                code : vm.selectedElement.code
            };
            vm.$http.post('/api/ui-elements/saveElement',data)
                    .then(function(response){
                        vm.refreshElements();
                        toastr.success('Success', '')
                    });
        },
        refreshElements(){
            var vm = this;
            var elements = [];
            vm.$http.get('/api/ui-elements/getAllElements')
                    .then(function(response){
                        vm.$set('elements', response.data);
                    });
        },
        syncElements(){
            var vm = this;
            vm.$http.get('/api/ui-elements/syncElements')
                    .then(function(response){
                        vm.refreshElements();
                    });
        }
    },
    ready(){
        var vm = this;
        vm.syncElements();
    }
}
</script>