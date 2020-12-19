<template>
<b-button variant="light" @click="backListPage(concept_id)">
    <b-icon icon="arrow-90deg-left" font-scale="1.2"></b-icon>
</b-button>
</template>

<script>
export default {
    props: {
        concept_id: String
    },
    methods: {
        backListPage: async function(concept_id) {
            this.$router.push('/concepts/' + Math.floor(await this.queryStartRateRank(concept_id) / 10 + 0.9))
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
        }
    }
}
</script>
