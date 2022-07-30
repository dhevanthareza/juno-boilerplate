<template>
    <textarea :identifier="identifier" :name="name" :id="ckeditorId"></textarea>
</template>

<script>
export default {
    props: ['name', 'identifier'],
    computed: {
        ckeditorId() {
            return 'ckeditor_' + this.identifier + '_' + this.name;
        }
    },
    data() {
        return {}
    },
    mounted() {
        ClassicEditor
            .create( document.querySelector( '#'+this.ckeditorId ) )
            .then( editor => {
                window[
                    editorGetAttr(this.identifier, this.name)
                ] = editor;
            } )
            .catch( error => {
                    // console.error( error );
            } );
    }
}
</script>