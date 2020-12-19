<template>
<div style="display: grid;grid-template-columns: 1fr 1fr;">
    <button class="concept-footer-button" @click.prevent="cover(concept,'upper')" :disabled="concept.layer >= 5">
        <b-icon icon="arrow-up" font-scale="1.2"></b-icon>
    </button>
    <button class="concept-footer-button" @click.prevent="cover(concept,'lower')" :disabled="concept.layer <= 1">
        <b-icon icon="arrow-down" font-scale="1.2"></b-icon>
    </button>
</div>
</template>

<script>
export default {
    data() {
        return {}
    },
    props: {
        concept: Object
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
