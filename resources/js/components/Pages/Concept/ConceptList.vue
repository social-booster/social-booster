<template>
<div>
    <ConceptRegister />
    <div style="display: grid; grid-template-columns: 1fr auto;position: sticky;top: 0;z-index: 1000;background: white;padding-bottom: 5px;padding-top: 5px;border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: #dfdfdf;">
        <ConceptListTerms v-if="is_verified" />
        <div class="text-right">
            <b-button variant="light" @click="register()">
                <b-icon icon="plus"></b-icon>
            </b-button>
        </div>
    </div>
    <div v-for="concept in concepts" :key="concept.id">
        <router-link :to="'/concept/' + concept.id" class="link">
            <ConceptFrame :concept="concept" />
        </router-link>
    </div>
    <div class="mt-3 mb-5" ref="paging_menu" style="height: 60px;">
        <b-button variant="light" v-show="page > 1" @click="paging(-1)">
            <b-icon icon="arrow-left" font-scale="1.2"></b-icon>
        </b-button>
        <b-button class="float-right" variant="light" v-show="concepts.length >= 10" @click="paging(+1)">
            <b-icon icon="arrow-right" font-scale="1.2"></b-icon>
        </b-button>
    </div>
</div>
</template>

<script>
import ConceptRegister from "../../Assets/ConceptRegister/ConceptRegister"
import ConceptFrame from "../../Assets/ConceptFrame/ConceptFrame"
import ConceptListTerms from "./ConceptListTerms"
export default {
    data() {
        return {
            concepts: []
        }
    },
    beforeRouteUpdate(to, from, next) {
        next()
        this.selectConcept(to.params.page)
    },
    components: {
        ConceptRegister,
        ConceptFrame,
        ConceptListTerms
    },
    props: {
        page: String
    },
    computed: {
        is_verified: function() {
            return this.$store.state.auth.is_verified
        },
        terms: function() {
            return this.$store.state.concept.terms
        }
    },
    created() {
        this.selectConcept(this.page)
    },
    mounted() {
        this.$root.$on('bv::modal::hide', (bvEvent, modalId) => {
            if (modalId === 'concept-register') {
                this.selectConcept(this.page)
            }
        })
    },
    watch: {
        terms: {
            handler: function() {
                this.selectConcept(this.page)
                if (this.page != 1) {
                    this.$router.push('/concepts/' + 1)
                }
            },
            deep: true
        }
    },
    methods: {
        paging: function(value) {
            this.$router.push('/concepts/' + (Number(this.page) + value))
            value === +1 ? scrollTo(0, 0) : scrollTo(0, this.$refs.paging_menu.offsetTop)
        },
        register: function() {
            this.$store.dispatch('concept/conceptRegister', {
                mode: 'register',
                concept: null
            })
        },
        selectConcept: function(page) {
            axios.get('/ajax/select/concept', {
                params: {
                    page: Number(page),
                    my_concept_only: this.terms.my_concept_only,
                    voted_concepts: this.terms.voted_concepts,
                    joined_community: this.terms.joined_community,
                    watching_concepts: this.terms.watching_concepts,
                    exclusion_layer: this.terms.exclusion_layer
                }
            }).then(function(response) {
                console.log(response.data)
                this.concepts = response.data
            }.bind(this)).catch(function(error) {
                console.log(error);
            });
        }
    }
}
</script>
