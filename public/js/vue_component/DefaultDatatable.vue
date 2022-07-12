<template>
    <table class="table align-items-center mb-0">
        <thead>
            <tr>
                <th
                    v-for="(header, index) in headers"
                    :key="index"
                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                >
                    {{ header }}
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(content, index) in contents" :key="index">
                <td v-for="(header, _index) in headers" :key="_index">
                    <span class="text-secondary text-xs font-weight-bold">{{
                        content[header]
                    }}</span>
                </td>
            </tr>
        </tbody>
    </table>
</template>
<script>
export default {
    props: ["url", "headers"],
    data() {
        return {
            contents: [],
            total: 0,
            page: 1,
            per_page: 15,
        };
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        async fetchData() {
            const { page, per_page } = this;
            const response = await httpClient(this.url, {
                params: { page, per_page },
            });
            const result = response.data.result;
            this.contents = result.data;
            this.total = result.total;
            showToast({title: "Success", message: "Berhasil Mengambil Data", type: "success"})
        },
    },
};
</script>
