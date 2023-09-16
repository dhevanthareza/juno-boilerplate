import CKEditor from "@ckeditor/ckeditor5-vue";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import Multiselect from "@vueform/multiselect";

(function () {
    window.Multiselect = Multiselect;
    window.CKEditor = CKEditor;
    window.ClassicEditor = ClassicEditor;
})();
