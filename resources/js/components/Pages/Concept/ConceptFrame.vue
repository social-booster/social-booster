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
            <div style="display: grid;grid-template-columns: 1fr auto auto auto auto auto auto;">
            <ConceptFrameStats :concept="concept" />
            <ConceptFrameProject :concept="concept" />
            <ConceptFrameCommunity :concept="concept" />
            <ConceptFrameWatch :concept="concept" />
            <ConceptFrameVote :concept="concept" />
            <ConceptFrameCover :concept="concept" />
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
import ConceptFrameWatch from "./ConceptFrameWatch"
import ConceptFrameCover from "./ConceptFrameCover"
export default {
    data() {
        return {
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
      ConceptFrameShare,
      ConceptFrameWatch,
      ConceptFrameCover
    }
}
</script>
