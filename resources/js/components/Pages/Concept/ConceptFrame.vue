<template>
<div>
    <b-card class="mt-2" footer-class="pt-1 pb-1" :header-class="'concept-color-' + concept.layer">
        <template v-slot:header>
            <span>{{concept.layer | layerName}}</span><span class="float-right">{{concept.user !== null ? concept.user.name : 'Anonymous'}}</span>
        </template>
        <h5 v-show="concept.name !== null">{{concept.name}}</h5>
        <hr v-show="concept.name !== null">
        <p>{{concept.content}}</p>
        <template v-slot:footer>
            <div style="display: grid;grid-template-columns: 1fr auto auto auto auto auto;">
            <ConceptFrameStats :concept="concept" />
            <ConceptFrameProject :concept="concept" />
            <ConceptFrameCommunity :concept="concept" />
            <ConceptFrameVote :concept="concept" />
            <button class="concept-footer-button" @click.prevent="cover(concept,'upper')" :disabled="concept.layer >= 5">
                <b-icon icon="arrow-up" font-scale="1.2"></b-icon>
            </button>
            <button class="concept-footer-button" @click.prevent="cover(concept,'lower')" :disabled="concept.layer <= 1">
                <b-icon icon="arrow-down" font-scale="1.2"></b-icon>
            </button>
            <ConceptFrameShare :concept="concept" />
          </div>
        </template>
    </b-card>
</div>
</template>

<script>
import ConceptFrameVote from "./ConceptFrameVote"
import ConceptFrameStats from "./ConceptFrameStats"
import ConceptFrameCommunity from "./ConceptFrameCommunity"
import ConceptFrameProject from "./ConceptFrameProject"
import ConceptFrameShare from "./ConceptFrameShare"
export default {
    data() {
        return {
          display: {
            stats: false
          }
        }
    },
    props: {
        concept: Object
    },
    components: {
      ConceptFrameVote,
      ConceptFrameStats,
      ConceptFrameCommunity,
      ConceptFrameProject,
      ConceptFrameShare
    },
    methods: {
        cover: function(concept, mode) {
            this.$store.dispatch('concept/conceptRegister', {
                mode: mode,
                concept: concept
            })
        }
    }
}
</script>
