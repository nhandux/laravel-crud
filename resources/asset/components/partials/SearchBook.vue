<template>
    <div class="text-center" style="margin: 20px 0px 20px 0px;">
        <form class="form-inline" @submit.prevent="searchBook">
            <div class="form-group">
                <input type="keywords" placeholder="Keyword" v-model="keywords" class="form-control" id="search">
            </div>
            <button type="submit" class="btn btn-default">{{title}}</button>
        </form>
    </div>
</template>
<script>
    export default {
        props: {
            title: String,
        },
        data() {
            return {
                keywords: ''
            }
        },
        methods: {
            searchBook() {
               this.$emit('search', this.keywords)
            }
        }
    }
</script>
