<template>
    <nav>
        <ul class="pagination justify-content-center">
            <li class="page-item" :disabled="isInFirstPage">
                <button class="page-link" @click="onClickFirstPage" > <i class="fa fa-angle-double-left"></i> </button>
            </li>
            <li class="page-item" :disabled="isInFirstPage">
                <button class="page-link" @click="onClickFirstPage" > <i class="fa fa-angle-left"></i> </button>
            </li>
            <li class="page-item" :disabled="isInFirstPage">
                <button class="page-link" type="button" @click="onClickPreviousPage">Prev </button>
            </li>
            <li class="page-item" v-if="(currentPage > 3)">
                <button class="page-link" @click="onClickFirstPage" >1</button>
            </li>
            <li class="page-item" v-if="(currentPage > 4)">
                <span class="page-link">...</span>
            </li>
            <li v-for="page in pages" v-if="(page.name >= currentPage - 2 && page.name <= currentPage + 2)" class="page-item">
                <button class="page-link" type="button" :active="isPageActive(page.name)" @click="onClickPage(page.name)"> {{ page.name }}</button>
            </li>
            <li class="page-item" v-if="(currentPage < totalPages - 3)">
                <span class="page-link">...</span>
            </li>
            <li class="page-item" v-if="(currentPage < totalPages - 2)">
                <button class="page-link" @click="onClickLastPage" >{{totalPages}}</button>
            </li>
            <li class="page-item">
                <button class="page-link" type="button" @click="onClickNextPage" :disabled="isInLastPage">Next</button>
            </li>
            <li class="page-item">
                <button class="page-link" type="button" @click="onClickLastPage" :disabled="isInLastPage"> <i class="fa fa-angle-right"></i> </button>
            </li>
            <li class="page-item">
                <button class="page-link" type="button" @click="onClickLastPage" :disabled="isInLastPage"> <i class="fa fa-angle-double-right"></i> </button>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    props: {
        maxVisibleButtons: {
            type: Number,
            required: false,
            default: 3
        },
        totalPages: {
            type: Number,
            required: true
        },
        total: {
            type: Number,
            required: true
        },
        currentPage: {
            type: Number,
            required: true
        }
    },
    data() {
        return {
            pre10: parseInt(this.currentPage) - 10 > 1 ? parseInt(this.currentPage) - 10 : 1,
            next10: parseInt(this.currentPage) + 10 > this.totalPages ? parseInt(this.currentPage) + 10 : this.totalPages
        }
    },
    computed: {
        isInFirstPage() {
            return this.currentPage === 1;
        },
        isInLastPage() {
            return this.currentPage === this.totalPages;
        },
        startPage() {
            if (this.currentPage === 1) {
                return 1;
            }
            if (this.currentPage === this.totalPages) {
                return this.totalPages - this.maxVisibleButtons;
            }
            return this.currentPage - 1;
        },
        pages() {
            const range = [];

            for (let i = this.startPage;
                i <= parseInt(this.totalPages);
                i+= 1 ) {
                    range.push({
                    name: i,
                });
            }

            return range;
        },
    },
    methods: {
        onClickFirstPage() {
            this.$emit('pagechanged', 1);
        },
        onClickPreviousPage() {
            this.$emit('pagechanged', this.currentPage - 1);
        },
        onClickPage(page) {
            this.$emit('pagechanged', page);
        },
        onClickNextPage() {
            this.$emit('pagechanged', this.currentPage + 1);
        },
        onClickLastPage() {
            this.$emit('pagechanged', this.totalPages);
        },
        isPageActive(page) {
            return this.currentPage === page;
        }
    }
};
</script>
