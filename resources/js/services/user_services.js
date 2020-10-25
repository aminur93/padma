/**
 * Created by aminur on 9/25/20.
 */

import {http, httpFile} from './http_services';

export function getUser(data) {
    return http().get('/user/get_user?'+ data);
}

export function getUserCount() {
    return http().get('/user/get_user_count');
}

export function getRole() {
    return http().get('/user/get_role');
}

export function getEditUser(id) {
    return http().get(`/user/edit/${id}`);
}

export function createUser(data) {
    return http().post('/user/store', data);
}

export function update(id, data) {
    return http().post(`/user/update/${id}`, data);
}

export function deleteUsers(id) {
    return http().delete(`/user/destroy/${id}`);
}
