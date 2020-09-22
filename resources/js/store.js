/**
 * Created by aminur on 9/22/20.
 */

import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        apiURL: 'http://localhost:8000',
        serverPath: "http://localhost:8000",
    },
    mutations:{},
    actions: {}
});
