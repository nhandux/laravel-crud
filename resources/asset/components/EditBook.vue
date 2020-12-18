<template>
    <div>
        <h3 class="text-center">Edit Book</h3>
        <div class="row">
            <div class="col-md-6" style="position: relative">
                <loading :active.sync="isLoading" :is-full-page="false"></loading>
                <form @submit.prevent="updateBook">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="book.name">
                    </div>
                    <div class="form-group">
                        <label>Author</label>
                        <input type="text" class="form-control" v-model="book.author">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Book</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import Loading from 'vue-loading-overlay';
    import 'vue-loading-overlay/dist/vue-loading.css';
    
    export default {
        data() {
            return {
                book: {},
                isLoading: true,
            }
        },
        components: {
            Loading
        },
        created() {
            this.axios
                .get(`/api/books/${this.$route.params.id}/edit`)
                .then((response) => {
                    this.book = response.data;
                    this.isLoading= false;
                });
        },
        methods: {
            updateBook() {
                this.axios
                    .put(`/api/books/${this.$route.params.id}`, this.book)
                    .then((response) => {
                        this.$router.push({name: 'home'});
                    });
            }
        }
    }
</script>
