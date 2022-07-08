<template>
    <textarea :name="name" id="ckeditor" v-model="teks"></textarea>
</template>

<script>
export default {
    props: ['name'],
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
    }
}
</script>