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
                    <li>Name</li>
                    <li>type</li>
                    <li>path</li>
                    <li>updated_at</li>
                    <li>created_at</li>
                </div>
                <div
                    class="media-item"
                    v-for="media in media_list | filterBy search"
                    v-bind:class="{ 'selected': media.selected }"
                    @click="select(media)"
                >
                    <li>{{ media.name }}</li>
                    <li>{{ media.type }}</li>
                    <li>{{ media.path }}</li>
                    <li>{{ media.updated_at }}</li>
                    <li>{{ media.created_at }}</li>
                </div>
            </div>
        </div>
    </div>
    <div class="dropzone-upload-container">
        <form action="/file-upload"
          class="dropzone"
          id="my-awesome-dropzone"></form>
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
</style>
<script>
export default
{
    props:{

    },
    data(){
        return{
            search: '',
            show: 'list',
            media_list:[
                {
                    name: 'Mappe #1',
                    type: 'folder',
                    path: '/',
                    created_at: new Date( Date.now() + 5000000).toUTCString(),
                    updated_at: new Date( Date.now() + 9000000).toUTCString()
                },
                {
                    name: 'Billede #1',
                    type: 'image',
                    path: '/Mappe #1',
                    created_at: new Date( Date.now() - 5000000).toUTCString(),
                    updated_at: new Date( Date.now() + 1000000).toUTCString()
                },
                {
                    name: 'PDF',
                    type: 'pdf',
                    path: '/',
                    created_at: new Date( Date.now() - 1000000).toUTCString(),
                    updated_at: new Date( Date.now() + 2000000).toUTCString()
                },
                {
                    name: 'TXT',
                    type: 'txt',
                    path: '/',
                    created_at: new Date( Date.now() + 1000000).toUTCString(),
                    updated_at: new Date( Date.now() + 7200000).toUTCString()
                },
                {
                    name: 'TXT',
                    type: 'txt',
                    path: '/',
                    created_at: new Date( Date.now() + 1000000).toUTCString(),
                    updated_at: new Date( Date.now() + 7200000).toUTCString()
                },
                {
                    name: 'TXT',
                    type: 'txt',
                    path: '/',
                    created_at: new Date( Date.now() + 1000000).toUTCString(),
                    updated_at: new Date( Date.now() + 7200000).toUTCString()
                },
                {
                    name: 'TXT',
                    type: 'txt',
                    path: '/',
                    created_at: new Date( Date.now() + 1000000).toUTCString(),
                    updated_at: new Date( Date.now() + 7200000).toUTCString()
                },
                {
                    name: 'TXT',
                    type: 'txt',
                    path: '/',
                    created_at: new Date( Date.now() + 1000000).toUTCString(),
                    updated_at: new Date( Date.now() + 7200000).toUTCString()
                }
            ]
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

        var Dropzone = require("dropzone");

        Dropzone.options.dropzone = {
            init: function () {
                this.on("complete", function (file) {
                    if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0)
                    {
                        this.removeAllFiles();
                        vm.refresh(vm.current_folder_id);
                    }
                });
            }
        };
    }
}
</script>