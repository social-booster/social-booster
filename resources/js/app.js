/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

window.Vue = require('vue');

import {
    BootstrapVue,
    IconsPlugin
} from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import router from "./router/router";
import store from './store/index';
import "../css/custom.css";
import VueAnalytics from 'vue-analytics'
import VueHead from 'vue-head'
import VueClipboard from 'vue-clipboard2'
VueClipboard.config.autoSetContainer = true // add this line
import VueRouter from 'vue-router'
import { VueReCaptcha } from 'vue-recaptcha-v3'

Vue.use(VueReCaptcha, { siteKey: process.env.MIX_RECAPTCHA_SITE_KEY })
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(VueRouter)
Vue.use(VueClipboard)
Vue.use(VueHead, {
  separator: '-',
  complement: 'SocialBooster'
})
Vue.use(VueAnalytics, {
    id: 'UA-176850917-1',
    router,
    debug: {
        sendHitTask: process.env.NODE_ENV === 'production'
    }
})

Vue.filter('layerName', function(layer) {
    const layer_names = {
        1: 'ストレス',
        2: 'ニーズ',
        3: 'アイデア',
        4: 'プロジェクト',
        5: 'コミュニティ'
    }
    return layer_names[layer]
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component('HeaderMenu', require('./components/Header/Menu/Menu.vue').default);
Vue.component('VerifyEmail', require('./components/Assets/VerifyEmail/VerifyEmail.vue').default);
Vue.component('MemberRegistrationButton', require('./components/Assets/MemberRegistrationButton/MemberRegistrationButton.vue').default);

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

store.dispatch('recaptcha/getSiteKey')
store.dispatch('user/getMyUserData')

router.beforeEach(async (to, from, next) => {
    var is_login = await store.dispatch('auth/checkLogin')
    store.dispatch('auth/checkVerified')
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (is_login) {
            next()
        } else {
            location.href = '/login'
        }
    }
    next()
})

const app = new Vue({
    el: '#app',
    router: router,
    store: store
});
