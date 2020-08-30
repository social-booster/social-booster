import Vue from 'vue';
import Vuex from 'vuex';
import 'es6-promise/auto'

import auth from "./modules/auth";
import user from "./modules/user";
import concept from "./modules/concept";
import cover from "./modules/cover";
import recapcha from "./modules/recapcha";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        auth,
        user,
        concept,
        cover,
        recapcha
    }
});
