<template>
    <div class="col">
      <label :for="`${name}-input`" class="form-label">{{ label }}</label>
      <textarea
        :id="`${name}-input`"
        :name="name"
        :label="label"
        v-model="value"
        type="text"
        :rows="rows"
        class="form-control"
        :placeholder="label"
        @blur="handleBlur"
      />
      <div class="text-red">{{ errorMessage }}</div>
    </div>
  </template>
  <script setup>
  import { useField } from "vee-validate";
  
  const emit = defineEmits(["update:modelValue"]);
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
      required: false,
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
    value: {
      type: String,
      default: null,
    },
    readonly: {
      type: Boolean,
      default: false,
    },
    rules: {
      default: undefined,
    },
    rows: {
      type: Number,
      default:3
    }
  });
  
  const { value, errorMessage, handleBlur } = useField(
    () => props.name,
    props.rules,
    {
      syncVModel: true,
    }
  );
  </script>
  