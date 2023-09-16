<template>
    <div class="card mb-4">
        <div class="card-header">
            <div class="card-head-row justify-content-between">
                <h4 class="card-title">
                    <strong>{{ title }}</strong>
                </h4>
                <div class="d-flex align-items-center">
                    <div class="form-group">
                        <div class="input-icon">
                            <input
                                type="text"
                                v-model="keyword"
                                class="form-control"
                                placeholder="Search for..."
                            />
                            <span class="input-icon-addon">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                    <div>
                        <a
                            v-if="canAdd"
                            :href="`${addDataLink ?? `${url}/create`}`"
                            type="button"
                            class="btn btn-primary btn-round ml-auto"
                        >
                            <div class="fa fa-fw fa-plus mr-2"></div>
                            {{ addDataText ?? "Add Data" }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Filter Modal Slot -->
            <slot name="filter-modal" :content="content"> </slot>
        </div>

        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table
                    class="table align-items-center mb-0 table-hover"
                    style="
                        min-width: 100%;
                        table-layout: fixed;
                        width: max-content;
                    "
                >
                    <thead class="bg-grey1">
                        <tr>
                            <th
                                v-for="(header, index) in headers"
                                :key="index"
                                :class="`text-${
                                    header['align'] ? header['align'] : 'center'
                                }`"
                                :style="header['style']"
                            >
                                <div
                                    @click="header.sortable ? handleHeaderClick(header) : null"
                                    style="cursor: pointer"
                                >
                                    {{ header["text"] }}
                                    <i v-if="header.sortable && sortBy.column == header.value && sortBy.type == 'ASC'" class="fas fa-arrow-up ml-2"></i>
                                    <i v-if="header.sortable && sortBy.column == header.value && sortBy.type == 'DESC'" class="fas fa-arrow-down ml-2"></i>
                                </div>
                            </th>
                            <th :style="actionStyle" class="text-center">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if="isContentLoading">
                            <td :colspan="headers.length + 1">
                                <div class="d-flex justify-content-center">
                                    <div class="loader loader-lg"></div>
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
                                    :style="header['style']"
                                >
                                    <slot
                                        :name="`${header['value']}`"
                                        :content="content"
                                        :value="content[header['value']]"
                                    >
                                        <span
                                            :class="`text-${
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
                                <td :style="actionStyle" class="text-center">
                                    <div class="d-flex">
                                        <slot
                                            name="left-action"
                                            :content="content"
                                        >
                                        </slot>
                                        <a
                                            v-if="canEdit"
                                            :href="`${url}/${content.id}/edit`"
                                            type="button"
                                            class="btn btn-xs bg-primary mr-1 text-white"
                                        >
                                            Edit
                                        </a>
                                        <button
                                            v-if="canDelete"
                                            @click="deleteData(content.id)"
                                            type="button"
                                            class="btn btn-xs btn-danger"
                                        >
                                            Delete
                                        </button>
                                        <slot
                                            name="right-action"
                                            :content="content"
                                        >
                                        </slot>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
            <div class="px-5 mt-4">
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
    props: {
        addDataText: {
            type: String,
            required: false,
            default: null,
        },
        addDataLink: {
            type: String,
            required: false,
            default: null,
        },
        url: {
            type: String,
            required: true,
        },
        listUrl: {
            type: String,
            required: false,
            default: null,
        },
        headers: {
            type: Array,
            required: true,
        },
        title: {
            type: String,
            reqired: true,
        },
        actionStyle: {
            type: String,
            reqired: false,
            default: null,
        },
        canAdd: {
            type: Boolean,
            default: true,
        },
        canEdit: {
            type: Boolean,
            default: true,
        },
        canDelete: {
            type: Boolean,
            default: true,
        },
        additionalFilter: {
            type: Object,
            default: {},
        },
        deleteMethod: {
            type: Function,
            required: true,
        },
    },
    data() {
        return {
            isContentLoading: false,
            contents: [],
            keyword: "",
            total: 0,
            page: 1,
            per_page: 10,
            isSearchFocused: false,
            sortBy: {
                column: null,
                type: null,
            },
        };
    },
    watch: {
        page(newPage, oldPage) {
            this.fetchData();
        },
        keyword() {
            this.fetchData();
        },
        sortBy() {
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
        handleHeaderClick(header) {
            if (this.sortBy.column == header.value && this.sortBy.type == "DESC") {
                this.sortBy = {
                    column: null,
                    type: null,
                };
                return;
            }
            if (this.sortBy.column == header.value) {
                this.sortBy = {
                    column: header.value,
                    type: "DESC",
                };
                return;
            }
            this.sortBy = {
                column: header.value,
                type: "ASC",
            };
        },
        async fetchData() {
            try {
                fetchController.abort();
            } catch (err) {}
            this.isContentLoading = true;
            const { page, per_page, keyword } = this;
            fetchController = new AbortController();
            const url =
                this.listUrl != null ? this.listUrl : `${this.url}/datatable`;
            const response = await httpClient.get(url, {
                signal: fetchController.signal,
                params: { page, per_page, keyword, ...this.additionalFilter, sortBy: this.sortBy },
            });
            const result = response.data.result;
            this.contents = result.data;
            this.total = result.total;
            this.isContentLoading = false;
        },
        async deleteData(id) {
            Swal.fire({
                title: "Are you sure want delete this data?",
                showDenyButton: true,
                confirmButtonText: `Yes`,
                denyButtonText: `No`,
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
