<template>
    <form @submit="onSubmit">
        <div class="row">
            <template v-for="schema in schemas">
                <div :class="`col-md-${schema.cols} pa-0`">
                    <slot :name="schema.name" v-bind="values">
                        <component
                            :is="schemaTypeToComponent[schema.type ?? 'text']"
                            :name="schema.name"
                            :label="schema.label"
                            class="px-2 py-0 mb-3"
                            :options="schema.options"
                            :option-text="schema.optionText"
                            :option-value="schema.optionValue"
                            :rows="schema.rows"
                        />
                    </slot>
                </div>
            </template>
        </div>
        <slot name="action">
            <div class="d-flex justify-content-end">
                <button
                    type="button"
                    class="btn btn-warning mr-1"
                    @click="$router.go(-1)"
                >
                    Back
                </button>
                <button type="submit" class="btn btn-primary">Buat Baru</button>
            </div>
        </slot>
    </form>
</template>
<script setup>
import { Form } from "vee-validate";
import { object as YupObject } from "yup";
import TextField from "./../form/TextField.vue";
// import NumberField from "./NumberField.vue";
import TextArea from "./../form/TextArea.vue";
import ImageInput from "./../form/ImageInput.vue";
// import SelectField from "./SelectField.vue";
// import Checkbox from "./Checkbox.vue";
// import RepresentativeSelect from "./../representative/RepresentativeSelect.vue";
import { useForm } from "vee-validate";
import { computed, onMounted } from "vue";

const emit = defineEmits(["inFocus", "submit"]);
const props = defineProps({
    schemas: {
        type: Array,
        default: [],
    },
    formValue: {
        type: Object,
        default: {},
    },
});

const schemaTypeToComponent = {
    text: TextField,
    textarea: TextArea,
    file: ImageInput
};

const validation_schema = computed(() => {
    const validations = {};
    props.schemas.forEach((schema) => {
        validations[schema.name] = schema.validation;
    });
    return YupObject(validations);
});

const { handleSubmit, resetForm, values } = useForm({
    initialValues: props.formValue,
    validationSchema: validation_schema,
});

function onInvalidSubmit({ values, errors, results }) {
    // console.log(values); // current form values
    // console.log(errors); // a map of field names and their first error message
    // console.log(results); // a detailed map of field names and their validation results
}

const onSubmit = handleSubmit((values) => {
    emit("submit", values);
}, onInvalidSubmit);

onMounted(async () => {
    resetForm({ values: props.formValue });
});
</script>
