<template>
<span>
    <span style="color: #666;" v-show="display">
        <span class="cover-footer-stats-name">紐付け比率</span>
        <span class="cover-footer-stats-value">{{cover.ratio}}</span>
        <span class="cover-footer-stats-unit">%</span>
        <span class="cover-footer-stats-name">紐付け投票数</span>
        <span class="cover-footer-stats-value">{{cover.votes}}</span>
    </span>
    <button class="concept-footer-button" @click.prevent="display = !display">
        <b-icon icon="bar-chart" font-scale="1.2"></b-icon>
    </button>
</span>
</template>

<script>
export default {
    data() {
        return {
          display: false
        }
    },
    props: {
        cover: Object
    },
    computed: {},
    created() {},
    mounted() {},
    methods: {}
}
</script>
