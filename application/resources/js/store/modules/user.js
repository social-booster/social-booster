const state = {
    my_user_data: {},
};

const mutations = {
    setMyUserData(state, my_user_data) {
        state.my_user_data = my_user_data
    }
};

const actions = {
    getMyUserData(context) {
        axios.get('/ajax/query/user/MyData', null)
            .then(function(response) {
                context.commit('setMyUserData', response.data)
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
