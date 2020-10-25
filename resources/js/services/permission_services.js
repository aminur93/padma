import { http, httpFile } from './http_services';

export function loadPermission(data) {
    return http().get('/permission/getData?'+ data);
}

export function addPermission(data) {
    return http().post('/permission/store', data);
}

export function editPermission(id) {
    return http().get(`/permission/edit/${id}`)
}

export function update(id, data) {
    return http().post(`/permission/update/${id}`, data);
}

export function deletePermission(id) {
    return http().delete(`/permission/destroy/${id}`);
}