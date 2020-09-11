<template>
<div class="text-center" style="display: grid;grid-template-columns: auto auto auto auto auto;">
    <b-button v-for="layer in [1,2,3,4,5]" :key="layer" :variant="create.layer === layer ? 'primary' : 'light'" size="sm" class="layer-button" @click="chooseLayer(layer)" :disabled="!(next_layer === layer || register.mode === 'register')">
        {{layer | layerName}}
    </b-button>
</div>
</template>

<script>
export default {
    computed: {
        create: function() {
            return this.$store.state.concept.create
        },
        register: function() {
            return this.$store.state.concept.register
        },
        next_layer: function() {
            return this.$store.getters. ['concept/next_layer']
        }
    },
    methods: {
        chooseLayer: function(layer) {
            this.$store.commit('concept/setCreate', {
                layer: layer,
                name: this.create.name,
                content: this.create.content
            })
        }
    }
}
</script>
