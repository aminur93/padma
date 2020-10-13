/**
 * Created by aminur on 9/26/20.
 */

import {http, httpFile} from './http_services';

export function createTag(data) {
    return http().post('/tag/store', data);
}

export function getTagsData() {
    return http().get('/tag/getData');
}

export function getTagCount() {
    return http().get('/tag/getTotalTag');
}

export function getTagDash() {
    return http().get('/tag/getTagDash');
}

export function editTagData(id) {
    return http().get(`/tag/edit/${id}`);
}

export function updateTag(id, data) {
    return http().post(`/tag/update/${id}`, data);
}

export function deleteTag(id) {
    return http().delete(`/tag/destroy/${id}`);
}
