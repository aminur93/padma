/**
 * Created by aminur on 10/19/20.
 */

import moment from 'moment';
import Vue from 'vue';

Vue.filter('timeformat',(arg)=>{
    return moment(arg).format("MMM Do YY");
});

Vue.filter('shortlength',function (text,length,suffix) {
    return text.substring(0,length)+ suffix;
});