<template>
    <SelectField
        v-bind="$attrs"
        :label="label"
        :options="options"
        option-text="kelurahan"
        option-value="id"
        :loading="isFetchingItems"
    />
</template>
<script setup>
import SelectField from "./SelectField.vue";
import { ref, onBeforeMount } from "vue";
const props = defineProps({
    label: {
        type: String,
        default: "Sub District",
    },
    districtId: {
        type: Number,
        default: null,
        required: false,
    },
});

const options = ref([]);
const isFetchingItems = ref(true);

const fetchItems = async () => {
    if (!props.districtId) {
        isFetchingItems.value = false;
        return;
    }
    try {
        const response = await httpClient.get(`${BASE_URL}/kelurahan/all`, {params: {
            district_id: props.districtId
        }});
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
