<template>
    <div class="media-container">
        <span class="media-controls">
            <button @click="add" class="btn btn-default product-control"><i class="fa fa-folder-open-o"></i> New Folder</button>
            <input v-model="search" class="form-control" placeholder="Search">
            <button @click="show = 'grid'" v-bind:class="{ 'btn-active': show == 'grid'}" class="btn btn-default product-control"><i class="fa fa-th"></i> Grid</button>
            <button @click="show = 'list'" v-bind:class="{ 'btn-active': show == 'list'}" class="btn btn-default product-control"><i class="fa fa-th-list"></i> List</button>
        </span>
        <div class="media-list-container">
            <div v-bind:class="{ 'media-list' : show == 'list', 'media-grid' : show == 'grid' }">
                <div class="media-head" v-if="show == 'list'">
                    <li>Id</li>
                    <li>Name</li>
                    <li>type</li>
                    <li>path</li>
                    <li>updated_at</li>
                    <li>created_at</li>
                    <li>Controls</li>
                </div>
                <div
                    class="media-item"
                    v-for="media in media_list | filterBy search"
                    v-bind:class="{ 'selected': media.selected }"
                    @click="select(media)"
                >
                    <li>{{ media.id }}</li>
                    <li><input class="media-update-control" type="text" name="" v-model="media.name"></li>
                    <li>{{ media.type }}</li>
                    <li>{{ media.path }}</li>
                    <li>{{ media.updated_at }}</li>
                    <li>{{ media.created_at }}</li>
                    <li><a class="btn btn-danger" v-if="media.type != 'folder'" @click="deleteMedia(media)">Delete</a></li>
                </div>
            </div>
        </div>
    </div>
    <div class="dropzone-upload-container">
        <form action="/media/upload" class="dropzone" id="dropzone">
            <input type="hidden" name="_token" value="{{ csrf_token }}">
            <input type="hidden" name="parent_id" value="{{ current_folder_id }}">
        </form>
    </div>
</template>
<style>
    .open .dropdown-toggle.btn-default{
        border-color: #1ab394 !important;
        background: rgba(26, 179, 148, 0.17) !important;
    }
    .btn-default:hover {
        border-color: #1ab394 !important;
        background: rgba(26, 179, 148, 0.17) !important;
    }
    .media-container{
        background: white;
        padding: 15px;
        display: flex;
        flex-direction: column;
        height: calc(100% - 150px);
    }
    .media-list-container{    
        height: 75vh;
        overflow-y: scroll;
        margin-right: -10px;
    }
    .media-controls{
        display: flex;
        width: 100%;
        margin-bottom: 15px;
        padding-bottom: 5px;
    }
    .media-grid {
        display: flex;
        flex-direction: row;
        align-content: space-around;
        flex-wrap: wrap;
    }
    .media-list {
        display: flex;
        flex-direction: column;
    }
    .media-list,.media-grid{
        flex: 1;
    }
    .media-head{
        display: flex;
        justify-content: space-between;
        font-weight: bold;
        font-size: 20px;
        margin-bottom: 10px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.04);
        padding-bottom: 5px;
    }
    .media-item {
        display: flex;
        justify-content: space-between;
        font-size: 14px;
        padding: 5px 0;
    }
    .media-item:hover {
        cursor: pointer;
    }
    .media-item li, .media-head li {
        flex: 1;
    }

    .media-grid .media-item {
        flex-direction: column;
        width: calc(25% - 30px);
        margin: 15px;
        border: 1px solid;
        padding: 5px;
    }
    .media-grid .media-item li:first-child {
        font-size: 20px;
        font-weight: bold;
    }
    .media-grid .media-item li {
        list-style: none;
    }
    .selected {
        border-bottom: 1px solid #1ab394 !important;
        margin-bottom: -1px;
        background: #eaeaea;
        padding: 5px 0;
        margin-top: 0;
    }
    .dropzone-upload-container {
        position: fixed;
        bottom: 15px;
        width: calc( 80vw - 60px);
        max-height: 200px;
        overflow-y: auto;
        overflow-x: hidden;
    }
    .media-update-control{
        height: 100%;
        width: 100%;
        padding: 0;
        margin: 0;
        border: 0;
        background: inherit;
    }
</style>
<script>
export default
{
    props:{
        media_list: {
            coerce: function (val) {
                return JSON.parse(val) // cast the value to Object
            }
        }
    },
    data(){
        return{
            search: '',
            show: 'list',
            csrf_token : Laravel.csrfToken,
            current_folder_id: 0
        }
    },
    computed: {

    },
    methods: {
        add: function(){
            let vm = this;
            let item = {
                    name: 'new Item',
                    type: 'folder',
                    path: '/',
                    selected: false,
                    created_at: new Date( Date.now() + 5000000).toUTCString(),
                    updated_at: new Date( Date.now() + 9000000).toUTCString()
            };
            vm.media_list.push(item);
        },
        select: function(media)
        {
            let vm = this;
            vm.deselect();
            Vue.nextTick(function () {
                media.selected = true;
            })
            // vm.media_list.forEach(function(element,index,array){
                // console.log(element.selected);
            // });
        },
        deselect: function()
        {
            let vm = this;
            vm.media_list.forEach(function(element,index,array){
                element.selected = false;
            });
        },
        deleteMedia: function(media)
        {
            let vm = this;
            vm.$http.post('/api/media/delete/'+media.id, { _method: 'DELETE' }).then(function(response){
                toastr.success('Succesfully Deleted File');
                vm.refresh(vm.current_folder_id);
            });
        },
        refresh: function(folder_id = null)
        {
            let vm = this;
            vm.$http.get('/api/media/getFiles/'+folder_id).then(function(response){
                vm.$set('media_list', response.data);
                vm.initialize();
            });
        },
        initialize: function(){
            let vm = this;
            vm.media_list.forEach(function(item, index, array){
                vm.$set('media_list['+index+'].selected', false);
            });
        }
    },
    ready(){
        let vm = this;
        vm.initialize();

        $('.media-update-control').on('focusout',function(){
            // ajax to update name
            console.log('updating');
        });


        var Dropzone = require("dropzone");

        Dropzone.options.dropzone = {
            init: function () {
                this.on("complete", function (file) {
                    if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0)
                    {
                        console.log('Queue Complete');
                        toastr.success('Succesfully Uploaded Files');
                        this.removeAllFiles();
                        vm.refresh(vm.current_folder_id);
                    }
                });
            }
        };
    }
}
</script>