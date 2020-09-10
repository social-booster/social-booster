<template>
<span>
    <button @click.prevent="concept.watching ? deleteWatch() : insertWatch()" class="concept-footer-button" :disabled="!is_verified">
        <b-icon :icon="concept.watching ? 'star-fill' : 'star'" font-scale="1"></b-icon>
    </button>
</span>
</template>

<script>
export default {
    data() {
        return {
            watching: true
        }
    },
    props: {
        concept: Object
    },
    computed: {
        is_verified: function() {
            return this.$store.state.auth.is_verified
        }
    },
    methods: {
        insertWatch: function() {
            axios.post('/ajax/insert/watch', {
                concept_id: this.concept.id
            }).then(function(response) {
                console.log(response.data)
                this.concept.watching = response.data
            }.bind(this)).catch(function(error) {
                console.log(error);
                alert('項目に問題があるか、プログラムに異常があるようです。')
            }.bind(this));
        },
        deleteWatch: function() {
            axios.post('/ajax/delete/watch', {
                concept_id: this.concept.id
            }).then(function(response) {
                console.log(response.data)
                this.concept.watching = response.data
            }.bind(this)).catch(function(error) {
                console.log(error);
                alert('項目に問題があるか、プログラムに異常があるようです。')
            }.bind(this));
        }
    }
}
</script>
