import AllBooks from '../asset/components/AllBooks.vue';
import AddBook from '../asset/components/AddBook.vue';
import EditBook from '../asset/components/EditBook.vue';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: AllBooks
    },
    {
        name: 'add',
        path: '/add',
        component: AddBook
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditBook
    }
];
