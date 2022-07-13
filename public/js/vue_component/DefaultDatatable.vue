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
                <th
                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                >
                    Actions
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
                <td>
                    <div class="d-flex">
                        <button
                            type="button"
                            class="btn btn-xs bg-primary me-1 text-white"
                        >
                            Edit
                        </button>
                        <button
                            @click="deleteData(content.id)"
                            type="button"
                            class="btn btn-xs btn-danger"
                        >
                            Delete
                        </button>
                    </div>
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
            const response = await httpClient.get(`${this.url}/datatable`, {
                params: { page, per_page },
            });
            const result = response.data.result;
            this.contents = result.data;
            this.total = result.total;
        },
        async deleteData(id) {
            Swal.fire({
                title: "Apakah anda yakin ingin menghapus data ini?",
                showDenyButton: true,
                confirmButtonText: `Yakin`,
                denyButtonText: `Tidak`,
            }).then(async (result) => {
                if (result.isConfirmed) {
                    await httpClient.delete(`${this.url}/${id}`);
                    Swal.fire("Data berhasil dihapus!", "", "success");
                    this.fetchData()
                } else if (result.isDenied) {
                    Swal.fire("Proses hapus dibatalkan", "", "info");
                    this.fetchData()
                }
            });
        },
    },
};
</script>
