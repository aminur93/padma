/**
 * Created by aminur on 9/22/20.
 */

import { http, httpFile } from './http_services';

export function addCategory(data) {
    return http().post('/category/store', data);
}

export function loadcategory() {
    return http().get('/category/getData');
}

export function getCat() {
    return http().get('/category/getCat');
}

export function getCount() {
    return http().get('/category/getTotalCategory');
}

export function catDash() {
    return http().get('/category/getCategoryDash');
}

export function deleteCategories(id) {
    return http().delete(`/category/destroy/${id}`);
}

export function getEditCategory(id) {
    return http().get(`/category/edit/${id}`);
}

export function updateCategory(id, data) {
    return http().post(`/category/update/${id}`, data);
}

export function getCategoryIdByBlog(data) {
    return http().get('/getCategoryByBlog?'+ data);
}
