require('./bootstrap');

require('alpinejs');

import Vue from 'vue'

//Main pages
import App from './vue/app.vue'

const app = new Vue({
    el: '#app',
    components: { App }
});
