/**
 * Created by aminur on 9/21/20.
 */

import AdminHome from './components/admin/AdminHome.vue';
import UserHome from './components/frontend/UserHome.vue';
import SingleBlog from './components/frontend/singleblog.vue';

//tag Routes
import Tag from './components/admin/tags/tag.vue';
import AddTag from './components/admin/tags/add_tag.vue';
import EditTag from './components/admin/tags/edit_tag.vue';

//Category Routes
import Category from './components/admin/category/category.vue';
import AddCategory from './components/admin/category/add_category.vue';
import EditCategory from './components/admin/category/edit_category.vue';

//Sub Categories Routes
import SubCategories from './components/admin/sub_category/sub_cat.vue';
import AddSubCat from './components/admin/sub_category/add_sub_cat.vue';
import EditSubCat from './components/admin/sub_category/edit_sub_cat.vue';

//Blog Post Routes
import BlogPost from './components/admin/blog_post/blog_post.vue';
import AddBlogPost from './components/admin/blog_post/add_Post.vue';
import EditBlogPost from './components/admin/blog_post/edit_post.vue';

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

    /*tag routes start*/
    {
        path: '/tag',
        name: 'tag',
        component: Tag
    },
    {
        path: '/add_tag',
        name: 'add_tag',
        component: AddTag
    },
    {
        path: '/edit_tag/:id',
        name: 'edit_tag',
        component: EditTag
    },
    /*tag routes end*/

    /*Categories Route Start*/
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

    /*Categories Route Start*/

    /*Sub Categories Route Start*/
    {
        path: '/sub_categories',
        name: 'sub_categories',
        component: SubCategories
    },
    {
        path: '/add_sub_cat',
        name: 'add_sub_cat',
        component: AddSubCat
    },
    {
        path: '/edit_sub_vat/:id',
        name: 'edit_sub_cat',
        component: EditSubCat
    },
    /*Sub Categories Route End*/

    /*Start Blog post Routes*/
    {
        path: '/blog_post',
        name: 'blog_post',
        component: BlogPost
    },
    {
        path: '/add_post',
        name: 'add_post',
        component: AddBlogPost
    },
    {
        path: '/edit_post/:id',
        name: 'edit_post',
        component: EditBlogPost
    },
    /*end Blog post Routes*/

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
    },

    /*
    * End user route
    * */

    {
        path: '/',
        name: 'user-home',
        component: UserHome,
    },

    {
        path: '/single_blog/:id',
        name: 'single-blog',
        component: SingleBlog
    }
];



