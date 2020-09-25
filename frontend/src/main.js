import Vue from 'vue'
import App from './App.vue'
import Axios from 'axios'
import router from './router'
import store from './store'

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import './registerServiceWorker'

Vue.use(BootstrapVue);
Vue.use(IconsPlugin);

Axios.defaults.baseURL = 'http://localhost:8000/api';

Vue.prototype.$axios = Axios;

Vue.config.productionTip = false

new Vue({
	router,
	store,
	render: h => h(App)
}).$mount('#app')
