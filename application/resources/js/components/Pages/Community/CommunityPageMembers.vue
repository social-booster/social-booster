<template>
    <div>
      <h1>Members</h1>
      <hr>
      <div v-for="(mem,id) in members" :key="id">
        {{mem.user.name}}
        <hr>
      </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                members: {}
            }
        },
        computed: {
          concept_id: function() {
            return this.$route.params.concept_id
          }
        },
        created: function() {
          this.selectMembers()
        },
        methods: {
          selectMembers: function() {
              axios.get('/ajax/select/community/members', {
                  params: {
                      concept_id: this.concept_id
                  }
              }).then(function(response) {
                  console.log(response.data)
                  this.members = response.data
              }.bind(this)).catch(function(error) {
                  console.log(error);
              });
          }
        }

    }
</script>
