<template>
    <div class="card mb-4">
        <div class="card-header pb-0">
            <div class="d-flex justify-content-between">
                <div>
                    <h6>{{ title ?? "" }}</h6>
                </div>
                <div>
                    <a
                        :href="`${url}/create`"
                        type="button"
                        class="btn btn-xs bg-primary me-1 text-white"
                    >
                        Add Data
                    </a>
                </div>
            </div>
            <div class="d-flex justify-content-between mb-5">
                <div :class="`input-group ${isSearchFocused ? 'focused' : ''}`">
                    <span class="input-group-text text-body"
                        ><i class="fas fa-search" aria-hidden="true"></i
                    ></span>
                    <input
                        v-model="keyword"
                        @focus="isSearchFocused = true"
                        @blur="isSearchFocused = false"
                        type="text"
                        class="form-control"
                        placeholder="Search Data"
                    />
                </div>
            </div>
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
                                    header['align'] ? header['align'] : 'center'
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
                                            : 'center'
                                    }`"
                                >
                                    <slot
                                        :name="`${header['value']}`"
                                        :content="content"
                                        :value="content[header['value']]"
                                    >
                                        <span
                                            :class="`text-secondary text-xs font-weight-bold text-${
                                                header['align']
                                                    ? header['align']
                                                    : 'left'
                                            }`"
                                            >{{
                                                resolve(
                                                    content,
                                                    header["value"]
                                                )
                                            }}</span
                                        >
                                    </slot>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a
                                            :href="`${url}/${content.id}/edit`"
                                            type="button"
                                            class="btn btn-xs bg-primary me-1 text-white"
                                        >
                                            Edit
                                        </a>
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
import PaginateContent from "./PaginateContent.vue";
let fetchController = new AbortController();
export default {
    components: { PaginateContent },
    props: ["url", "headers", "title"],
    data() {
        return {
            isContentLoading: false,
            contents: [],
            keyword: "",
            total: 0,
            page: 1,
            per_page: 5,
            isSearchFocused: false,
        };
    },
    watch: {
        page(newPage, oldPage) {
            this.fetchData();
        },
        keyword() {
            this.fetchData()
        }
    },
    created() {
        this.fetchData();
    },
    methods: {
        resolve(obj, path, separator = ".") {
            var properties = path.split(separator);
            return properties.reduce((prev, curr) => prev && prev[curr], obj);
        },
        handlePageItemClick(page) {
            this.page = page;
        },
        async fetchData() {
            try {
                fetchController.abort();
            } catch (err) {}
            this.isContentLoading = true;
            const { page, per_page, keyword } = this;
            fetchController = new AbortController();
            const response = await httpClient.get(`${this.url}/datatable`, {
                signal: fetchController.signal,
                params: { page, per_page, keyword },
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
};
</script>
