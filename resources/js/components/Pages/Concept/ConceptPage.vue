<template>
<div v-if="loaded">
    <b-button variant="light" @click="backListPage(concept_id)">
        <b-icon icon="arrow-90deg-left" font-scale="1.2"></b-icon>
    </b-button>
    <ConceptRegister />
    <ConceptFrame :concept="concept" />
    <ConceptPageCover :concept_id="concept.id" :concept_layer="concept.layer" />
</div>
<div class="text-center" v-else>
    <b-spinner variant="secondary" style="height: 3rem;width: 3rem;" label="Loading..."></b-spinner>
</div>
</template>

<script>
import ConceptRegister from "./ConceptRegister"
import ConceptFrame from "./ConceptFrame"
import ConceptPageCover from "./ConceptPageCover"
export default {
    beforeRouteUpdate(to, from, next) {
        this.queryConcept(to.params.concept_id)
        next()
    },
    data() {
        return {
            loaded: false,
            concept: Object,
            covers: Array,
            covers_select_mode: 'upper'
        }
    },
    props: {
        concept_id: String
    },
    components: {
        ConceptRegister,
        ConceptFrame,
        ConceptPageCover
    },
    created() {
        this.queryConcept(this.concept_id)
    },
    methods: {
        backListPage: async function(concept_id) {
            this.$router.push('/concepts/' + (Number(String(await this.queryStartRateRank(concept_id)).slice(0,-1)) + 1))
        },
        queryStartRateRank: async function(concept_id) {
            return await axios.get('/ajax/query/concept/StartRateRank', {
                params: {
                    concept_id: concept_id
                }
            }).then(function(response) {
                return response.data
            }.bind(this)).catch(function(error) {
                console.log(error);
            });
        },
        queryConcept: function(concept_id) {
            axios.get('/ajax/query/concept', {
                    params: {
                        concept_id: concept_id
                    }
                }).then(function(response) {
                    this.concept = response.data
                    this.loaded = true
                    this.$emit('updateHead');
                }.bind(this))
                .catch(function(error) {
                    console.log(error);
                });
        }
    },
    head: {
        title: function() {
            return {
                inner: this.concept.layer === 5 || this.concept.layer === 4 ? this.concept.name : this.concept.content
            }
        },
        meta: function() {
            return [{
                name: 'description',
                content: this.concept.content,
                id: 'desc'
            }]
        }
    }
}
</script>
