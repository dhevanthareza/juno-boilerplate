<template>
    <div class="col px-1">
      <label :for="`${name}-input`" class="form-label">{{ label }}</label>
      <Multiselect
        v-model="value"
        :name="name"
        :items="options"
        :placeholder="label"
        :options="options"
        :loading="loading"
        :searchable="true"
      >
      </Multiselect>
      <div class="text-red">{{ errorMessage }}</div>
    </div>
  </template>
  <script setup>
  import { useField } from "vee-validate";
  import Multiselect from '@vueform/multiselect'
  import { toRef, computed } from "vue";
  const props = defineProps({
    modelValue: {
      default: null,
    },
    type: {
      type: String,
      default: "text",
    },
    name: {
      type: String,
      required: true,
    },
    label: {
      type: String,
      required: true,
    },
    successMessage: {
      type: String,
      default: "",
    },
    placeholder: {
      type: String,
      default: "",
    },
    optionText: {
      type: String,
      default: null,
    },
    optionValue: {
      type: String,
      default: null,
    },
    options: {
      type: Array,
      default: [],
    },
    loading: {
      type: Boolean,
      default: false,
    },
  });
  
  const name = toRef(props, "name");
  
  const options = computed(() => props.options.map(option => {
    if(typeof option != 'object') {
      return option
    }
    return {
      value: option[props.optionValue],
      label: option[props.optionText]
    }
  }))
  
  const { value, errorMessage, handleBlur } = useField(
    () => props.name,
    props.rules,
    {
      syncVModel: true,
    }
  );
  </script>
  