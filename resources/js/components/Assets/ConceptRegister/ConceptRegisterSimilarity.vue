<template>
<div v-show="similarities.length > 0">
    <div class="text-center">
        <p class="mb-0 mt-2" style="color: #022544;">同じ内容のものはありませんか？</p>
        <p style="color: #022544;font-size: x-small;">殆ど同じ内容での紐付け、登録はおやめください。</p>
    </div>
    <router-link :to="'/concept/' + similarity.id" class="p-2" v-for="(similarity,id) in similarities " :key="id">
        <p class="similarity-name">{{similarity.name}}</p>
        <p class="similarity-content">{{similarity.content}}</p>
        <div class="text-right" v-show="!(register.mode === 'register')">
            <b-button :variant="select === similarity ? 'dark' : 'light'" size="sm" @click.prevent="setSelect(select === similarity ? Object : similarity)" :disabled="Boolean(isCoverd(similarity.id))">
                {{select === similarity ? '選択を解除する' : isCoverd(similarity.id) ? '既に紐付けられています' : '紐付ける'}}
            </b-button>
        </div>
        <hr class="similarity-hr">
    </router-link>
</div>
</template>

<script>
export default {
    data() {
        return {
            similarities: [],
            covers: []
        }
    },
    created: async function() {
        if (this.is_cover_mode_enabled) {
            this.covers = await this.selectCover(this.register.base.id, this.register.mode)
        }
    },
    mounted: function() {
        this.$root.$on('bv::modal::hide', (bvEvent, modalId) => {
            if (modalId === 'concept-register') {
                this.similarities = []
                this.covers = []
            }
        })
    },
    computed: {
        is_cover_mode_enabled: function() {
            return this.$store.getters. ['concept/is_cover_mode_enabled']
        },
        register: function() {
            return this.$store.state.concept.register
        },
        create: function() {
            return this.$store.state.concept.create
        },
        select: function() {
            return this.$store.state.concept.select
        }
    },
    watch: {
        create: {
            handler: function() {
                if (this.register.mode !== 'hide') {
                    this.serchSimilaritiesConcept()
                }
            },
            deep: true
        }
    },
    methods: {
        setSelect: function(select) {
            this.$store.commit('concept/setSelect', select)
        },
        isCoverd: function(concept_id) {
            return this.covers.find(function(u) {
                if (u[this.register.mode + '_concept'] === undefined) {
                    return true
                }
                return u[this.register.mode + '_concept'].id === concept_id
            }.bind(this));
        },
        selectCover: async function(concept_id, mode) {
            return await axios.get('/ajax/select/cover', {
                params: {
                    concept_id: concept_id,
                    mode: mode
                }
            }).then(function(response) {
                return response.data
            }.bind(this)).catch(function(error) {
                console.log(error);
            });
        },
        serchSimilaritiesConcept: function() {
            axios.get('/ajax/serch/concept/similarities', {
                params: {
                    layer: this.create.layer,
                    content: this.create.content
                }
            }).then(function(response) {
                //console.log(response.data)
                this.similarities = response.data
            }.bind(this)).catch(function(error) {
                console.log(error);
            });
        }
    }
}
</script>
