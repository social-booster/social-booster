<template>
<div v-if="loaded">
    <ConceptPageBackButton :concept_id="concept.id" />
    <ConceptRegister />
    <ConceptFrame :concept="concept" :is_individual_page="true" />
    <ConceptPageCover :concept_id="concept.id" :concept_layer="concept.layer" />
</div>
<div v-else-if="is_not_found" class="text-center">
    <h1>404 Not Found</h1>
    <p>コンセプトが見つかりません。</p>
</div>
<div class="text-center" v-else>
    <b-spinner variant="secondary" style="height: 3rem;width: 3rem;" label="Loading..."></b-spinner>
</div>
</template>

<script>
import ConceptRegister from "../../Assets/ConceptRegister/ConceptRegister"
import ConceptFrame from "../../Assets/ConceptFrame/ConceptFrame"
import ConceptPageCover from "./ConceptPageCover"
import ConceptPageBackButton from "./ConceptPageBackButton"
export default {
    beforeRouteUpdate(to, from, next) {
        this.queryConcept(to.params.concept_id)
        next()
    },
    data() {
        return {
            loaded: false,
            is_not_found: false,
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
        ConceptPageCover,
        ConceptPageBackButton
    },
    created() {
        this.queryConcept(this.concept_id)
    },
    methods: {
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
                    this.is_not_found = true
                }.bind(this));
        },
        metaTitle: function() {
            return this.concept.layer === 5 || this.concept.layer === 4 ? this.concept.name : this.concept.content
        },
        metaDescription: function() {
            return this.concept.content
        }
    },
    head: {
        title: function() {
            return {
                inner: this.metaTitle()
            }
        },
        meta: function() {
            return [{
                    name: 'description',
                    content: this.metaDescription(),
                    id: 'description'
                },
                {
                    name: 'twitter:card',
                    content: 'summary',
                    id: 'twitter:card'
                },
                {
                    name: 'twitter:title',
                    content: this.metaTitle(),
                    id: 'twitter:title'
                },
                {
                    name: 'twitter:description',
                    content: this.metaDescription(),
                    id: 'twitter:description'
                },
                {
                    property: 'og:type',
                    content: 'article',
                    id: 'og:type'
                },
                {
                    property: 'og:title',
                    content: this.metaTitle(),
                    id: 'og:title'
                },
                {
                    property: 'og:description',
                    content: this.metaDescription(),
                    id: 'og:description'
                },
                {
                    name: 'robots',
                    content: this.is_not_found ? 'noindex,nofollow' : 'all',
                    id: 'robots'
                },
                {
                    name: 'author',
                    content: this.concept.user,
                    id: 'author'
                }
            ]
        }
    }
}
</script>
