<template>
<div>
    <h2>参加コミュニティ</h2>
    <hr>
    <div v-for="(com,id) in communites" :key="id">
      <ConceptFrame :concept="com.concept" />
    </div>
    <div v-if="communites.length <= 0">
      参加コミュニティがないようです。
    </div>
</div>
</template>

<script>
import ConceptFrame from "../Concept/ConceptFrame"
export default {
    data() {
        return {
          communites: []
        }
    },
    components: {
      ConceptFrame
    },
    created() {
      this.queryJoinedCommunity()
    },
    computed: {
        my_user_data: function() {
            return this.$store.state.user.my_user_data
        }
    },
    methods: {
      queryJoinedCommunity: function() {
          axios.get('/ajax/query/JoinedCommunity', null)
          .then(function(response) {
            console.log(response.data)
            this.communites = response.data
          }.bind(this)).catch(function(error) {
              console.log(error);
          });
      }
    }
}
</script>
