<template>
    <SelectField
      v-bind="$attrs"
      :label="label"
      :options="options"
      option-text="kecamatan"
      option-value="id"
      :loading="isFetchingItems"
    />
  </template>
  <script setup>
  import SelectField from './SelectField.vue';
  import { ref, onBeforeMount  } from "vue"
  const props = defineProps({
    label: {
      type: String,
      default: "District",
    },
  });
  
  const options = ref([]);
  const isFetchingItems = ref(true);
  
  const fetchItems = async () => {
    try {
      const response = await httpClient.get(`${BASE_URL}/kecamatan/all`);
      options.value = response.data.result;
      isFetchingItems.value = false;
    } catch (err) {
      console.log(err)
      isFetchingItems.value = false;
    }
  };
  
  onBeforeMount(() => {
    fetchItems();
  });
  </script>
  