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
            <div style="display: grid;grid-template-columns: 1fr auto auto auto auto;">
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
      ConceptFrameProject
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

<style>
@import "/css/custom.css";

.concept-footer-button {
    background: none;
    border: none;
}

.card-header {
    background-color: rgba(255, 255, 255, 0.03);
}

.card-footer {
    background-color: rgba(255, 255, 255, 0.03);
    text-align: right;
}

.concept-color-5 {
    border-bottom-width: 10px;
    border-bottom-color: #9788ff;
}

.concept-color-4 {
    border-bottom-width: 10px;
    border-bottom-color: #88ffe3
}

.concept-color-3 {
    border-bottom-width: 10px;
    border-bottom-color: #a2ff88;
}

.concept-color-2 {
    border-bottom-width: 10px;
    border-bottom-color: #ffd688;
}

.concept-color-1 {
    border-bottom-width: 10px;
    border-bottom-color: #ff9494;
}
</style>
