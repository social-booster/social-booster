<template>
<span v-if="concept.layer === 4">
    <button class="concept-footer-button text-right" @click.prevent="$bvModal.show('project/' + concept.id);countEngagedCommunities()">
        <b-icon icon="chat-dots" font-scale="1"></b-icon>
    </button>
    <b-modal :id="'project/' + concept.id" hide-footer hide-header>
        <div class="text-center">
            <hr style="color: bla;background: #88ffe3;height: 10px;border-radius: 10px;">
            <h2 style="border: none;padding: 0;">{{concept.name}}</h2>
            <p>{{concept.content}}</p>
            <hr>
            <p style="color: #595959;font-size: 0.8rem;">只今の参画コミュニティ数</p>
            <p style="font-size: 1.8rem;color: #424242;">{{engaged_communities}}</p>

            <b-button variant="primary" @click="$router.push('/project/' + concept.id)">
                {{'進捗を見る'}}
            </b-button>
        </div>
    </b-modal>
</span>
</template>

<script>
export default {
    data() {
        return {
          engaged_communities: 0
        }
    },
    props: {
        concept: Object
    },
    methods: {
      countEngagedCommunities: function() {
          axios.get('/ajax/query/project/EngagedCommunities', {
              params: {
                  concept_id: this.concept.id
              }
          }).then(function(response) {
            console.log(response.data)
            this.engaged_communities = response.data
          }.bind(this)).catch(function(error) {
              console.log(error);
          });
      }
    }
}
</script>
