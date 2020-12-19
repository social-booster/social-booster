<template>
<div>
    <h2>About</h2>
    <router-link :to="'/concept/' + concept.id">
        <h3>{{concept.name}}</h3>
    </router-link>
    <hr>
    <p>{{concept.content}}</p>
</div>
</template>

<script>
export default {
    data() {
        return {
            concept: {}
        }
    },
    created() {
        this.queryCommunity()
    },
    computed: {
        concept_id: function() {
            return this.$route.params.concept_id
        }
    },
    methods: {
        queryCommunity: function() {
            axios.get('/ajax/query/community', {
                params: {
                    concept_id: this.concept_id
                }
            }).then(function(response) {
                console.log(response.data)
                this.concept = response.data
            }.bind(this)).catch(function(error) {
                console.log(error);
            });
        }
    }

}
</script>
