const state = {
    is_login: false,
    is_login_loaded: false,
    is_verified: false,
    is_verified_loaded: false
};

const mutations = {
    setCheckLogin(state, is_login) {
        state.is_login = is_login
        state.is_login_loaded = true
    },
    setCheckVerified(state, is_verified) {
        state.is_verified = is_verified
        state.is_verified_loaded = true
    }
};

const actions = {
    async checkLogin(context) {
        return await axios.get('/ajax/check/auth', null).then((data) => {
            context.commit('setCheckLogin', data.data)
            return data.data
        })
    },
    async checkVerified(context) {
        return await axios.get('/ajax/check/verified', null).then((data) => {
            context.commit('setCheckVerified', data.data)
            return data.data
        })
    },
    async logout(context) {
        return await axios.post('/ajax/logout', null).then(function(response) {
            location.href = "/concepts/1"
            return response.data
        }.bind(this)).catch(function(error) {
            console.log(error);
            alert('項目に問題があるか、プログラムに異常があるようです。')
        }.bind(this));
    },

}

export default {
    namespaced: true,
    state,
    mutations,
    actions
};
