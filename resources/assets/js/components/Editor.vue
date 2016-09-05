<template>
    <textarea id="editor" class="editor"></textarea>
</template>
<style>
    .ace-editor{
        height: 600px;
    }
</style>
<script>
export default
{
    props:{
    },
    data(){
        return{
            editor: {}
        }
    },
    computed: {
    },
    events: {
        'update-editor': function (content) {
            if (content == undefined) {
                content = '';
            }
            var editor = this.$get('editor');
            editor.setValue(content, -1);
        }
    },
    methods: {
        updateContent(){
            var vm = this;
            var editor = vm.$get('editor');
            vm.$nextTick(function () {
                vm.$dispatch('update-editor', editor.getValue());
            });
        }
    },
    ready(){
        var vm = this;
        var ace = require('brace');
        require('brace/mode/html');
        require('brace/theme/twilight');
        require('brace/ext/emmet');

        var ace_editor = ace.edit('editor');
        vm.$set('editor',ace_editor);

        ace.config.set("basePath", "/js/vendor/AceEditor");
        ace_editor.getSession().setMode('ace/mode/html');
        ace_editor.setTheme('ace/theme/twilight');
        ace_editor.setOption("enableEmmet", true);
        ace_editor.$blockScrolling = Infinity;
        ace_editor.setOption("maxLines", 150);
        ace_editor.setOption("minLines", 30);
        ace_editor.on("blur", function(){ vm.updateContent(); });

    }
}
</script>