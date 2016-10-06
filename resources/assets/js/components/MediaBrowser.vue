<template>
    <div class="media-container">
        <span class="media-controls">
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                New <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#">Folder</a></li>
                    <li><a href="#">Upload</a></li>
                </ul>
            </div>
            <input v-model="search" class="form-control">
            <button @click="show = 'grid'" v-bind:class="{ 'btn-active': show == 'grid'}" class="btn btn-default product-control"><i class="fa fa-th"></i> Grid</button>
            <button @click="show = 'list'" v-bind:class="{ 'btn-active': show == 'list'}" class="btn btn-default product-control"><i class="fa fa-th-list"></i> List</button>
        </span>
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
            >
                <li>{{ media.name }}</li>
                <li>{{ media.type }}</li>
                <li>{{ media.path }}</li>
                <li>{{ media.updated_at }}</li>
                <li>{{ media.created_at }}</li>
            </div>
        </div>
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
        margin: 5px 0;
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
        
    },
    ready(){
        
    }
}
</script>