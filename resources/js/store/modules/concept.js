const state = {
    all_concept_votes: 0,
    register: {
        mode: '',
        base: {
            concept_id: '',
            concept_layer: ''
        }
    },
    terms: {
        my_concept_only: false,
        voted_concepts: false,
        joined_community: false,
        watching_concepts: false,
        exclusion_layer: []
    }
};

const mutations = {
    conceptRegister(state, {
        mode,
        concept
    }) {
        state.register.mode = mode
        state.register.base = concept
    },
    setAllConceptVotes(state, value) {
        state.all_concept_votes = value
    },
    setTerms(state, {
        my_concept_only,
        voted_concepts,
        joined_community,
        watching_concepts,
        exclusion_layer
    }) {
        state.terms = {
            my_concept_only: my_concept_only,
            voted_concepts: voted_concepts,
            joined_community: joined_community,
            watching_concepts: watching_concepts,
            exclusion_layer: exclusion_layer
        }
    }
};

const actions = {
    conceptRegister(context, {
        mode,
        concept
    }) {
        context.commit('conceptRegister', {
            mode: mode,
            concept: concept
        })
    },
    getAllConceptVotes(context, user_id) {
        axios.get('/ajax/query/allConceptVotes', {
                params: {
                    user_id: user_id
                }
            })
            .then(function(response) {
                context.commit('setAllConceptVotes', response.data)
            }.bind(this))
            .catch(function(error) {
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
