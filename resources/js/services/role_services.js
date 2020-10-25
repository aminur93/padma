/**
 * Created by aminur on 9/22/20.
 */

import {http, httpFile} from './http_services';

export function getRole(data) {
    return http().get('/roles/getData?'+ data);
}

export function getPermission() {
    return http().get('/roles/getPermission');
}

export function createRole(data) {
    return http().post('/roles/store', data);
}

export function getAllData(id)
{
    return http().get(`/roles/edit/${id}`);
}

export function updateRole(id, data) {
    return http().post(`/roles/update/${id}`, data);
}

export function deleteRoles(id) {
    return http().delete(`/role/destroy/${id}`);
}
