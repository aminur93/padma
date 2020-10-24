/**
 * Created by aminur on 9/26/20.
 */

import {http, httpFile} from './http_services';

export function getAllCat() {
    return http().get('/sub_cat/getCatData');
}

export function getSubCat() {
    return http().get('/subcategory/getSubCategory');
}

export function getData(data) {
    return http().get('/sub_cat/getData?'+ data);
}

export function createSubCat(data) {
    return http().post('/sub_cat/store', data);
}

export function editSubCat(id) {
    return http().get(`/sub_cat/edit/${id}`);
}

export function updateSubCat(id, data) {
    return http().post(`/sub_cat/update/${id}`, data);
}

export function deleteSubCat(id) {
    return http().delete(`/sub_cat/destroy/${id}`);
}
