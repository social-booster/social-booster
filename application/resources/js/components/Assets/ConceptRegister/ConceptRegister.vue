<template>
<div>
    <b-modal id="concept-register" hide-footer hide-header>
        <ConceptRegisterLayerSelection />
        <ConceptRegisterLayerDescription />
        <ConceptRegisterBase />
        <ConceptRegisterInput />
        <ConceptRegisterSimilarity />
        <ConceptRegisterSubmit />
    </b-modal>
    <ConceptRegisterSuccessModal />
</div>
</template>

<script>
import ConceptRegisterLayerSelection from "./ConceptRegisterLayerSelection"
import ConceptRegisterLayerDescription from "./ConceptRegisterLayerDescription"
import ConceptRegisterBase from "./ConceptRegisterBase"
import ConceptRegisterSimilarity from "./ConceptRegisterSimilarity"
import ConceptRegisterInput from "./ConceptRegisterInput"
import ConceptRegisterSubmit from "./ConceptRegisterSubmit"
import ConceptRegisterSuccessModal from "./ConceptRegisterSuccessModal"
export default {
    components: {
        ConceptRegisterLayerSelection,
        ConceptRegisterLayerDescription,
        ConceptRegisterBase,
        ConceptRegisterSimilarity,
        ConceptRegisterInput,
        ConceptRegisterSubmit,
        ConceptRegisterSuccessModal
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
