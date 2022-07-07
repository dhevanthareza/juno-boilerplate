<template>
    <div id="ckeditor" v-html="teks"></div>
</template>

<script>
export default {
    data() {
        return {
            teks: "This is some sample content."
        }
    },
    mounted() {
        ClassicEditor
            .create( document.querySelector( '#ckeditor' ) )
            .then( editor => {
                    // console.log( editor );
            } )
            .catch( error => {
                    // console.error( error );
            } );
    },
    updated() {
        console.log(teks)
    }
}
</script>