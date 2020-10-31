/**
 * Created by aminur on 9/21/20.
 */

import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import AdminMaster from './components/admin/AdminMaster.vue';

import UserHome from './components/frontend/UserHome.vue';

const routes = [

    {
        path: '/home',
        component: AdminMaster,
        children: [
            {
                path: '',
                name: 'home',
                component: () => import('./components/admin/AdminHome.vue')
            },

            {
                path: 'category',
                name: 'category',
                component: () => import('./components/admin/category/category.vue'),
            },

            {
                path: 'add',
                name: 'add',
                component: () => import('./components/admin/category/add_category.vue')
            },

            {
                path: 'edit_category/:id',
                name: 'edit_category',
                component: () => import('./components/admin/category/edit_category.vue')
            },

            {
                path: 'tag',
                name: 'tag',
                component: () => import('./components/admin/tags/tag.vue')
            },
            {
                path: 'add_tag',
                name: 'add_tag',
                component: () => import('./components/admin/tags/add_tag.vue')
            },
            {
                path: 'edit_tag/:id',
                name: 'edit_tag',
                component: () => import('./components/admin/tags/edit_tag.vue')
            },

            /*Sub Categories Route Start*/
            {
                path: 'sub_categories',
                name: 'sub_categories',
                component: () => import('./components/admin/sub_category/sub_cat.vue')
            },
            {
                path: 'add_sub_cat',
                name: 'add_sub_cat',
                component: () => import('./components/admin/sub_category/add_sub_cat.vue')
            },
            {
                path: 'edit_sub_vat/:id',
                name: 'edit_sub_cat',
                component: () => import('./components/admin/sub_category/edit_sub_cat.vue')
            },
            /*Sub Categories Route End*/

            /*Start Blog post Routes*/
            {
                path: 'blog_post',
                name: 'blog_post',
                component: () => import('./components/admin/blog_post/blog_post.vue')
            },
            {
                path: 'add_post',
                name: 'add_post',
                component: () => import('./components/admin/blog_post/add_Post.vue')
            },
            {
                path: 'edit_post/:id',
                name: 'edit_post',
                component: () => import('./components/admin/blog_post/edit_post.vue')
            },
            /*end Blog post Routes*/

            /*
             * this is permission routes list
             * */

            {
                path: 'permission',
                name: 'permission',
                component: () => import('./components/admin/permissions/permission.vue')
            },

            {
                path: 'add_permission',
                name: 'add_permission',
                component: () => import('./components/admin/permissions/add_permission.vue')
            },

            {
                path: 'edit_permission/:id',
                name: 'edit_permission',
                component: () => import('./components/admin/permissions/edit_permission.vue')
            },

            /*
             * end this is permission routes list
             * */

            /*
             * start roles route
             * */

            {
                path: 'role',
                name: 'role',
                component: () => import('./components/admin/roles/role.vue')
            },

            {
                path: 'add_role',
                name: 'add_role',
                component: () => import('./components/admin/roles/add_role.vue')
            },

            {
                path: 'edit_role/:id',
                name: 'edit_role',
                component: () => import('./components/admin/roles/edit_role.vue')
            },

            /*
             * end roles route
             * */

            /*
             * Start user Route
             * */

            {
                path: 'user',
                name: 'user',
                component: () => import('./components/admin/user/user.vue')
            },

            {
                path: 'add_user',
                name: 'add_user',
                component: () => import('./components/admin/user/add_user.vue')
            },

            {
                path: 'edit_user/:id',
                name: 'edit_user',
                component: () => import('./components/admin/user/edit_user.vue')
            },

            /*
             * End user route
             * */
        ],
    },


    {
        path: '/',
        name: 'user-home',
        component: UserHome,
    },

    {
        path: '/single_blog/:id',
        name: 'single-blog',
        component: () => import('./components/frontend/singleblog.vue'),
        props: true
    },

    {
        path: '/category_blog/:id',
        name: 'category-blog',
        component: () => import('./components/frontend/categoryByShow.vue')
    },

    {
        path: '/tag_blog/:id',
        name: 'tag-blog',
        component: () => import('./components/frontend/tagByShow.vue')
    }
];

const router = new VueRouter({
    mode: 'history',
    routes: routes,
    linkActiveClass: 'active'
});

export default router;



