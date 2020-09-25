/**
 * Created by aminur on 9/21/20.
 */

import AdminHome from './components/admin/AdminHome.vue';

//Category Routes
import Category from './components/admin/category/category.vue';
import AddCategory from './components/admin/category/add_category.vue';
import EditCategory from './components/admin/category/edit_category.vue';

//roles and permission
import Permission from './components/admin/permissions/permission.vue';
import AddPermission from './components/admin/permissions/add_permission.vue';
import EditPermission from './components/admin/permissions/edit_permission.vue';

//roles component
import Roles from './components/admin/roles/role.vue';
import AddRole from './components/admin/roles/add_role.vue';
import EditRole from './components/admin/roles/edit_role.vue';

//User Component
import User from './components/admin/user/user.vue';
import AddUser from './components/admin/user/add_user.vue';
import EditUser from './components/admin/user/edit_user.vue';

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
        name: 'add',
        component: AddCategory
    },

    {
        path: '/edit_category/:id',
        name: 'edit_category',
        component: EditCategory
    },

    /*
     * this is permission routes list
     * */

    {
        path: '/permission',
        name: 'permission',
        component: Permission
    },

    {
        path: '/add_permission',
        name: 'add_permission',
        component: AddPermission
    },

    {
        path: '/edit_permission/:id',
        name: 'edit_permission',
        component: EditPermission
    },

    /*
     * end this is permission routes list
     * */

    /*
    * start roles route
    * */

    {
        path: '/role',
        name: 'role',
        component: Roles
    },

    {
        path: '/add_role',
        name: 'add_role',
        component: AddRole
    },

    {
        path: '/edit_role/:id',
        name: 'edit_role',
        component: EditRole
    },

    /*
     * end roles route
     * */

    /*
    * Start user Route
    * */

    {
        path: '/user',
        name: 'user',
        component: User
    },

    {
        path: '/add_user',
        name: 'add_user',
        component: AddUser
    },

    {
        path: '/edit_user/:id',
        name: 'edit_user',
        component: EditUser
    }

    /*
    * End user route
    * */
];



