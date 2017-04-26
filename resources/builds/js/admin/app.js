require('./bootstrap');

import Vue from 'vue'
import App from './components/App.vue'
import store from './store'
import router from './router'
import VeeValidate from 'vee-validate'

Vue.use(VeeValidate)

new Vue({
    router,
    store,
    template: '<App></App>',
    components: {App}
}).$mount('#app')
