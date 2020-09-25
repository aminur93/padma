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

export function deleteCategories(id) {
    return http().delete(`/category/destroy/${id}`);
}

export function getEditCategory(id) {
    return http().get(`/category/edit/${id}`);
}

export function updateCategory(id, data) {
    return http().post(`/category/update/${id}`, data);
}
