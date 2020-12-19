const state = {
    site_key: ''
};

const mutations = {
    setSiteKey(state, site_key) {
        state.site_key = site_key
    }
};

const actions = {
    getSiteKey(context) {
        axios.get('/ajax/query/recaptcha/SiteKey', null)
            .then(function(response) {
                context.commit('setSiteKey', response.data)
            }.bind(this)).catch(function(err) {
                console.log(err);
            }.bind(this));
    }
}


export default {
    namespaced: true,
    state,
    mutations,
    actions
};
