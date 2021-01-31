<template>
<section class="front-card text-left mt-4">
    <section v-for="(concept,id) in concepts" :key="id">
        <router-link :to="'/concept/' + concept.id" style="color: #000000c9;text-decoration: none;">
            <div style="display: grid;grid-template-columns: auto 10fr;">
                <b-icon icon="chat-fill" font-scale="2"></b-icon>
                <p class="ml-3 mt-1">{{concept.content}}</p>
            </div>
        </router-link>
        <hr v-if="concept.id !== final_concept">
    </section>
</section>
</template>

<script>
export default {
    data() {
        return {
            concepts: Array
        }
    },
    created: function() {
        this.selectConcept(1)
    },
    computed: {
        terms: function() {
            return this.$store.state.concept.terms
        },
        final_concept: function() {
          return this.concepts.slice(-1)[0].id
        }
    },
    methods: {
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
                this.concepts = response.data
            }.bind(this)).catch(function(error) {
                console.log(error);
            });
        }
    }
}
</script>
