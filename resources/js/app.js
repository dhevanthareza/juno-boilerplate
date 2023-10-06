import CKEditor from "@ckeditor/ckeditor5-vue";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import Multiselect from "@vueform/multiselect";
import DynamicForm from "./components/common/DynamicForm.vue";
import * as Yup from "yup";
import * as Vue from "vue/dist/vue.esm-bundler.js";
import { FormTool } from "./tools/FormTools";
import DefaultDatatable from "./components/common/DefaultDatatable.vue";
import VueDatePicker from '@vuepic/vue-datepicker';
import DistrictSelect from "./components/form/DistrictSelect.vue";
import SubDistrictSelect from "./components/form/SubDistrictSelect.vue"
(function () {
    window.Yup = Yup;
    window.Multiselect = Multiselect;
    window.CKEditor = CKEditor;
    window.ClassicEditor = ClassicEditor;
    window.DynamicForm = DynamicForm;
    window.Vue = Vue;
    window.FormTool = FormTool;
    window.DefaultDatatable = DefaultDatatable;
    window.VueDatePicker = VueDatePicker;
    window.DistrictSelect = DistrictSelect;
    window.SubDistrictSelect = SubDistrictSelect
})();
