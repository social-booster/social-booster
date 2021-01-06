<template>
<span style="display: grid;grid-template-columns: 1fr auto;">
    <span v-show="display" style="color: rgb(102, 102, 102); white-space: nowrap; overflow: hidden; width: 100%; float: left;">
      <span class="concept-footer-stats-name">着手率</span>
      <span class="concept-footer-stats-value">{{concept.start_rate}}</span>
      <span class="concept-footer-stats-unit">%</span>
      <span class="concept-footer-stats-name">対応率</span>
      <span class="concept-footer-stats-value">{{concept.actions_ratio}}</span>
      <span class="concept-footer-stats-unit">%</span>
      <span class="concept-footer-stats-name">対応数</span>
      <span class="concept-footer-stats-value">{{concept.actions}}</span>
      <span class="concept-footer-stats-name">期待率</span>
      <span class="concept-footer-stats-value">{{concept.additional_votes_ratio}}</span>
      <span class="concept-footer-stats-unit">%</span>
      <span class="concept-footer-stats-name">加算得票数</span>
      <span class="concept-footer-stats-value">{{concept.additional_votes}}</span>
      <span class="concept-footer-stats-name">得票数</span>
      <span class="concept-footer-stats-value">{{concept.votes}}</span>
    </span>
    <button class="concept-footer-button text-right" @click.prevent="display = !display">
        <b-icon icon="bar-chart" font-scale="1"></b-icon>
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
        concept: Object
    },
}
</script>
