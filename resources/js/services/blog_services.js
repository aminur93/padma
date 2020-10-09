/**
 * Created by aminur on 9/30/20.
 */

import {http, httpFile} from './http_services';

export function getCategory() {
    return http().get('/blog/get_category');
}

export function Subcat() {
    return http().get('/blog/get_sub_category');
}

export function getSubcategory(category_id) {
    return http().get(`/blog/get_subCategory/${category_id}`);
}

export function getTag() {
    return http().get('/blog/get_tag');
}

export function getBlogPost() {
    return http().get('/blog/getAllBlog');
}

export function storeBlog(data) {
    return httpFile().post('/blog/store', data);
}

export function getEditBlogPost(id) {
    return http().get(`/blog/edit/${id}`);
}

export function updateBlog(id, data) {
    return httpFile().post(`/blog/update/${id}`, data);
}

export function deleteBlogPost(id) {
    return http().delete(`/blog/destroy/${id}`);
}