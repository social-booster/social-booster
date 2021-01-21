<template>
<div v-if="register.base !== null" class="mb-3" style="background: rgb(250, 251, 251) none repeat scroll 0% 0%; padding: 10px; border-radius: 10px;">
    <p class="base-concept-name" v-if="register.base.name !== null">{{register.base.name}}</p>
    <p class="base-concept-content mb-0">{{register.base.content}}</p>
</div>
</template>

<script>
export default {
    computed: {
        register: function() {
            return this.$store.state.concept.register
        }
    }
}
</script>
