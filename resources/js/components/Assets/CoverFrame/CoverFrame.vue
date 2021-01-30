<template>
<router-link :to="'/concept/' + concept.id" class="link">
    <b-card tag="section" class="mt-2">
        <hr :class="'hr-' + concept.layer">
        <span>{{concept.layer | layerName}}</span>
        <span class="float-right">{{concept.user !== null ? concept.user.name : 'Anonymous'}}</span>
        <hr>
        <h2 v-show="concept.name !== null" class="cover-name">{{concept.name}}</h2>
        <p>{{strLimit(concept.content,140)}}</p>
        <aside class="text-right">
            <CoverFrameStats v-show="mode === 'upper'" :cover="cover" />
            <CoverFrameVote v-show="mode === 'upper'" :cover="cover" />
        </aside>
    </b-card>
</router-link>
</template>

<script>
import CoverFrameVote from "./CoverFrameVote"
import CoverFrameStats from "./CoverFrameStats"
export default {
    data() {
        return {
            concept: Object
        }
    },
    components: {
        CoverFrameVote,
        CoverFrameStats
    },
    props: {
        cover: Object,
        mode: String
    },
    created() {
        this.concept = this.cover[this.mode + '_concept']
    }
}
</script>
