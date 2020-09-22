/**
 * Created by aminur on 9/22/20.
 */

import { http, httpFile } from './http_services';

export function addCategory(data) {
    return http().post('/category/store', data);
}
