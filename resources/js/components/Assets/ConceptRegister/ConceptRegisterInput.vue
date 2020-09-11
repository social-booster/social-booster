<template>
<div>
    <div v-if="create.layer === 4 || create.layer === 5">
        <b-form-input type="text" v-model="create.name" :placeholder="layer_meta.name.placeholder" debounce="500" :disabled="select !== Object"></b-form-input>
        <div v-show="create.name.length >= layer_meta.name.limit" class="text-right" style="color: red;">
            {{layer_meta.name.limit - create.name.length}}
        </div>
    </div>
    <div class="mt-3">
        <b-form-textarea v-model.trim="create.content" :placeholder="layer_meta.content.placeholder" rows="6" debounce="500" :disabled="select !== Object">
        </b-form-textarea>
        <div v-show="create.content.length >= layer_meta.content.limit" class="text-right" style="color: red;">
            {{layer_meta.content.limit - create.content.length}}
        </div>
    </div>
</div>
</template>

<script>
export default {
    computed: {
        register: function() {
            return this.$store.state.concept.register
        },
        create: {
            get() {
                return this.$store.state.concept.create
            },
            set(value) {
                this.$store.commit('concept/setCreate', value)
            }
        },
        select: function() {
            return this.$store.state.concept.select
        },
        layer_meta: function() {
            return this.$store.state.concept.layer_metas[this.create.layer]
        }
    }
}
</script>
