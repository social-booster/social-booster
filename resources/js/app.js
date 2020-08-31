/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
 if (location.hostname !== 'localhost' && location.protocol === 'http:') {
   location.href = 'https:' + '//' + location.hostname + location.pathname
 }
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
import VueAnalytics from 'vue-analytics'

import VueRouter from 'vue-router'
import { VueReCaptcha } from 'vue-recaptcha-v3'

Vue.use(VueReCaptcha, { siteKey: process.env.MIX_RECAPTCHA_SITE_KEY })
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(VueRouter)
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


Vue.filter('layerDescription', function(layer) {
    var description = {
        1: 'ストレス層では問題や課題の発見、認識を行います。',
        2: 'ニーズ層ではどうしたいのかについて明確にします。',
        3: 'アイデア層は解決の方向性を提示します。',
        4: 'プロジェクト層では具体的な手段を計画します。',
        5: 'コミュニティ層では実際に行動する集団を組織します。',
    }
    return description[layer]
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */


Vue.component('HeaderMenu', require('./components/Header/Menu/Menu.vue').default);

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
