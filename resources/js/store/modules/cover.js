const state = {
    all_cover_votes: 0,
};

const mutations = {
    setPrivateAllCoverVotes(state, value) {
        state.all_cover_votes = value
    }
};

const actions = {
    getPrivateAllCoverVotes(context, {user_id,cover_id}) {
        axios.get('/ajax/query/PrivateAllCoverVotes', {
            params: {
                user_id: user_id,
                cover_id: cover_id
            }
        }).then(function(response) {
            context.commit('setPrivateAllCoverVotes', response.data)
        }.bind(this)).catch(function(error) {
            console.log(error);
        });
    }
}

export default {
    namespaced: true,
    state,
    mutations,
    actions
};
