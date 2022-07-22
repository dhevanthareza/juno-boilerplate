<template>
    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>Employee</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th
                                v-for="(header, index) in headers"
                                :key="index"
                                :class="`text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-${
                                    header['align'] ? header['align'] : 'left'
                                }`"
                            >
                                {{ header["text"] }}
                            </th>
                            <th
                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                            >
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if="isContentLoading">
                            <td :colspan="headers.length + 1">
                                <div class="d-flex justify-content-center">
                                    <div
                                        class="spinner-border text-primary"
                                        role="status"
                                    >
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <template v-if="!isContentLoading">
                            <tr
                                v-for="(content, index) in contents"
                                :key="index"
                            >
                                <td
                                    v-for="(header, _index) in headers"
                                    :key="_index"
                                    :class="`text-${
                                        header['align']
                                            ? header['align']
                                            : 'left'
                                    }`"
                                >
                                    <span
                                        :class="`text-secondary text-xs font-weight-bold text-${
                                            header['align']
                                                ? header['align']
                                                : 'left'
                                        }`"
                                        >{{ content[header["value"]] }}</span
                                    >
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
                        </template>
                    </tbody>
                </table>
            </div>
            <div class="px-5">
                <paginate-content
                    @onPageClick="handlePageItemClick"
                    :page="page"
                    :per_page="per_page"
                    :total="total"
                />
            </div>
        </div>
    </div>
</template>
<script>
export default {
    components: {
        ...commonComponentMap(["PaginateContent"]),
    },
    props: ["url", "headers"],
    data() {
        return {
            isContentLoading: false,
            contents: [],
            total: 0,
            page: 1,
            per_page: 5,
        };
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        handlePageItemClick(page) {
            this.page = page;
        },
        async fetchData() {
            this.isContentLoading = true;
            const { page, per_page } = this;
            const response = await httpClient.get(`${this.url}/datatable`, {
                params: { page, per_page },
            });
            const result = response.data.result;
            this.contents = result.data;
            this.total = result.total;
            this.isContentLoading = false;
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
                    this.fetchData();
                } else if (result.isDenied) {
                    Swal.fire("Proses hapus dibatalkan", "", "info");
                    this.fetchData();
                }
            });
        },
    },
    watch: {
        page(newPage, oldPage) {
            this.fetchData();
        },
    },
};
</script>
