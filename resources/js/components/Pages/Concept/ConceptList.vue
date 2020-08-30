<template>
<div>
    <ConceptRegister />
    <div class="text-right">
        <b-button variant="primary" @click="register">
            投稿する
        </b-button>
    </div>
    <hr>
    <div v-for="concept in concepts" :key="concept.id">
        <router-link :to="'/concept/' + concept.id" class="link">
            <ConceptFrame :concept="concept" />
        </router-link>
    </div>
    <div class="mt-3" ref="paging_menu">
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
import ConceptRegister from "./ConceptRegister"
import ConceptFrame from "./ConceptFrame"
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
        ConceptFrame
    },
    props: {
        page: String
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
                    page: Number(page)
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

<style>
.link {
    color: black;
    text-decoration: none !important;
}

.link:hover {
    color: #626262;
}
</style>
