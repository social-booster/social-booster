const state = {
    all_concept_votes: 0,
    register: {
        mode: '',
        base: {}
    },
    create: {
        layer: 1,
        name: '',
        content: ''
    },
    select: Object,
    terms: {
        my_concept_only: false,
        voted_concepts: false,
        joined_community: false,
        watching_concepts: false,
        exclusion_layer: []
    },
    success_modal: Object,
    layer_metas: {
        1: {
            content: {
                placeholder: '社会での不平や不満、問題や課題について、「が問題だ、課題だ、不快だ、不満だ」という形で述べてください',
                limit: 140
            }
        },
        2: {
            content: {
                placeholder: '社会がどうあるべきかについて、「が欲しい、であるべき」という形で述べてください',
                limit: 70
            }
        },
        3: {
            content: {
                placeholder: '社会に対して提案したい工夫やアイデアについて、「をする」という形で述べてください',
                limit: 35
            }
        },
        4: {
            name: {
                placeholder: 'プロジェクトの名前です。',
                limit: 20
            },
            content: {
                placeholder: 'このプロジェクトが何をするものなのか可能な限り具体的に述べてください',
                limit: 800
            }
        },
        5: {
            name: {
                placeholder: 'コミュニティの名前です。',
                limit: 10
            },
            content: {
                placeholder: 'このコミュニティはどのような方向性を目指すかについて述べてください',
                limit: 400
            }
        }
    }
};

const getters = {
    is_cover_mode_enabled: state => {
        return state.register.mode === 'upper' || state.register.mode === 'lower'
    },
    next_layer: (state, getters) => {
        if (!getters.is_cover_mode_enabled) {
            return null
        }
        return state.register.base.layer + (state.register.mode === 'upper' ? +1 : -1)
    }
}

const mutations = {
    conceptRegister(state, {
        mode,
        concept
    }) {
        state.register = {
            mode: mode,
            base: concept
        }
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
    },
    setCreate(state, create) {
        state.create = create
    },
    setSelect(state, select) {
        state.select = select
    },
    setSuccessModal(state, value) {
        state.success_modal = value
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
    getters,
    mutations,
    actions
};
