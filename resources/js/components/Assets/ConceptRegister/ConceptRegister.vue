<template>
<div>
    <b-modal id="concept-register" hide-footer hide-header>
        <ConceptRegisterLayerSelection />
        <div class="mb-3 mt-3">
            {{create.layer | layerDescription}}
        </div>
        <ConceptRegisterBase />
        <ConceptRegisterInput />
        <ConceptRegisterSimilarity />
        <ConceptRegisterSubmit />
    </b-modal>
</div>
</template>

<script>
import ConceptRegisterLayerSelection from "./ConceptRegisterLayerSelection"
import ConceptRegisterBase from "./ConceptRegisterBase"
import ConceptRegisterSimilarity from "./ConceptRegisterSimilarity"
import ConceptRegisterInput from "./ConceptRegisterInput"
import ConceptRegisterSubmit from "./ConceptRegisterSubmit"
export default {
    components: {
        ConceptRegisterLayerSelection,
        ConceptRegisterBase,
        ConceptRegisterSimilarity,
        ConceptRegisterInput,
        ConceptRegisterSubmit
    },
    data() {
        return {}
    },
    mounted() {
        this.$root.$on('bv::modal::hide', (bvEvent, modalId) => {
            if (modalId === 'concept-register') {
                this.$store.dispatch('concept/conceptRegister', {
                    mode: 'hide',
                    concept: null
                })
                this.$store.commit('concept/setCreate', {
                    layer: 1,
                    name: '',
                    content: ''
                })
                this.$store.commit('concept/setSelect', Object)
            }
        })
    },
    computed: {
        register: function() {
            return this.$store.state.concept.register
        },
        create: function() {
            return this.$store.state.concept.create
        },
        is_verified: function() {
            return this.$store.state.auth.is_verified
        },
        is_cover_mode_enabled: function() {
            return this.$store.getters. ['concept/is_cover_mode_enabled']
        },
        next_layer: function() {
            return this.$store.getters. ['concept/next_layer']
        },
    },
    watch: {
        register: {
            handler: function() {
                if (this.register.mode !== 'hide') {
                    this.$bvModal.show('concept-register')
                }
                if (this.is_cover_mode_enabled) {
                    this.$store.commit('concept/setCreate', {
                        layer: this.next_layer,
                        name: this.create.name,
                        content: this.create.content
                    })
                }
            },
            deep: true
        }
    }
}
</script>
