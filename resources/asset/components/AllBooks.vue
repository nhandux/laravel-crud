<template>
    <div>
        <h3 class="text-center">All Books</h3><br/>
        <search-book :title="`Search Book`" @search="searchBook"/>
        <table class="table table-bordered" style="position: relative">
            <loading :active.sync="isLoading" :is-full-page="false"></loading>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Author</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <tr v-if="!books.length">
                <td colspan="6" align="center">Data empty in table</td>
            </tr>
            <tr v-for="book in books" :key="book.id">
                <td>{{ book.id }}</td>
                <td>{{ book.name }}</td>
                <td>{{ book.author }}</td>
                <td>{{ book.created_at }}</td>
                <td>{{ book.updated_at }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'edit', params: { id: book.id }}" class="btn btn-primary">Edit
                        </router-link>
                        <button class="btn btn-danger" @click="deleteBook(book.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <modal name="my-first-modal">
            <code>
                npm install --save vue-js-modal <br />
                ... <br />
                import vmodal from 'vue-js-modal' <br />
                Vue.use(vmodal) <br />
            </code></modal>
        <button @click="show()" class="btn btn-default">Show modal</button>
        <notifications group="foo" />
        <button @click="showNotification()" class="btn btn-default">Show Notification</button>
    </div>
</template>

<script>
    import SearchBook from './partials/SearchBook';
    import Loading from 'vue-loading-overlay';
    import 'vue-loading-overlay/dist/vue-loading.css';

    export default {
        data() {
            return {
                books: [],
                isLoading: true
            }
        },
        components: {
            Loading,
            SearchBook
        },
        created() {
            this.axios
                .get('/api/books')
                .then(response => { 
                    this.isLoading = false;
                    this.books = response.data;
                });
        },
        methods: {
            deleteBook(id) {
                this.isLoading = true;
                this.axios
                    .delete(`/api/books/${id}`)
                    .then(response => {
                        let i = this.books.map(item => item.id).indexOf(id); 
                        this.books.splice(i, 1)
                        this.isLoading = false;
                    });
            },
            doAjax() {
                this.isLoading = true;
                setTimeout(() => {
                  this.isLoading = false
                },5000)
            },
            onCancel() {
              console.log('User cancelled the loader.')
            },
            searchBook (keywords) {
                this.isLoading = true;
                this.axios
                .get('/api/books?keywords=' + keywords)
                .then(response => { 
                    this.isLoading = false;
                    this.books = response.data;
                });
            },
            show () {
                this.$modal.show('my-first-modal');
            },
            hide () {
                this.$modal.hide('my-first-modal');
            },
            showNotification () {
                this.$notify({
                    group: 'foo',
                    title: 'Important message',
                    text: 'Hello user! This is a notification!'
                });
            }
        }
    }
</script>
