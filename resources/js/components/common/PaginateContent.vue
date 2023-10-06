<template>
    <nav>
        <ul class="pagination justify-content-end">
            <li
                @click="page != 1 && $emit('onPageClick', page - 1)"
                :class="`page-item ${
                    page == 1 ? 'disabled' : 'cursor-pointer'
                }`"
            >
                <a class="page-link" tabindex="-1">
                    <i class="fa fa-angle-left"></i>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <li
                v-for="(item, index) in paginateItem"
                :key="index"
                :class="`page-item cursor-pointer ${
                    item == page ? 'active' : ''
                }`"
                @click="$emit('onPageClick', item)"
            >
                <span
                    :class="`page-link ${item == page ? 'text-white' : ''}`"
                    >{{ item == 0 ? "..." : item}}</span
                >
            </li>
            <li
                @click="page != pageCount && $emit('onPageClick', page + 1)"
                :class="`page-item ${
                    page == pageCount ? 'disabled' : 'cursor-pointer'
                }`"
            >
                <a class="page-link" href="javascript:;">
                    <i class="fa fa-angle-right"></i>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>
</template>
<script>
export default {
    props: ["page", "total", "per_page"],
    computed: {
        pageCount() {
            return Math.ceil(this.total / this.per_page);
        },
        paginateItem() {
            const totalPages = this.pageCount;
            const currentPage = this.page;
            const rangeToShow = 2;
            const compressedPagination = [];

            let prevHidden = false;
            for (let i = 1; i <= totalPages; i++) {
                if (
                    i === 1 ||
                    i === totalPages ||
                    Math.abs(i - currentPage) <= rangeToShow
                ) {
                    compressedPagination.push(i);
                    prevHidden = false;
                } else {
                    if (!prevHidden) {
                        compressedPagination.push(0);
                        prevHidden = true;
                    }
                }
            }

            return compressedPagination;
        },
    },
};
</script>
