/**
 * Created by aminur on 9/21/20.
 */

import AdminHome from './components/admin/AdminHome.vue';
import Category from './components/admin/category/category.vue';
import AddCategory from './components/admin/category/add_category.vue';

export const routes = [
    {
        path: '/home',
        component: AdminHome
    },

    {
        path: '/category',
        name: 'category',
        component: Category,
    },

    {
        path: '/add',
        component: AddCategory
    }
];



