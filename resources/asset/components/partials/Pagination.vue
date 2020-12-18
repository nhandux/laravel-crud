<template>
    <ul>
        <li>
            <button type="button" @click="onClickFirstPage" :disabled="isInFirstPage"> First</button>
        </li>
        <li>
            <button type="button" @click="onClickPreviousPage" :disabled="isInFirstPage">Previous </button>
        </li>
        <li v-for="page in pages">
            <button type="button" @click="onClickPage(page.name)" :disabled="page.isDisabled"> {{ page.name }}</button>
        </li>
        <li>
            <button type="button" @click="onClickNextPage" :disabled="isInLastPage">Next</button>
        </li>
        <li>
            <button type="button" @click="onClickLastPage" :disabled="isInLastPage"> Last </button>
        </li>
    </ul>
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
                i <= Math.min(this.startPage + this.maxVisibleButtons - 1, this.totalPages);
                i+= 1 ) {
                    range.push({
                    name: i,
                    isDisabled: i === this.currentPage
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
        }
    }
};
</script>
