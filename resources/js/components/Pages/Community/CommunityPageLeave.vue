<template>
<div>
    <h2>コミュニティを脱退する</h2>
    <hr>
    <p>本当にコミュニティを脱退しますか？</p>
    <b-button variant="danger" @click="leaveCommunity()" :disabled="!is_joined">
        脱退する
    </b-button>
</div>
</template>

<script>
export default {
    data() {
        return {
            is_joined: false
        }
    },
    created() {
      this.checkJoined()
    },
    computed: {
        concept_id: function() {
            return this.$route.params.concept_id
        }
    },
    methods: {
        leaveCommunity: function() {
            axios.post('/ajax/leave/community', {
                concept_id: this.concept_id
            }).then(function(response) {
                console.log(response.data)
                this.checkJoined()
            }.bind(this)).catch(function(error) {
                console.log(error);
                alert('項目に問題があるか、プログラムに異常があるようです。')
            }.bind(this));
        },
        checkJoined: function() {
            axios.get('/ajax/check/joined', {
                params: {
                    concept_id: this.concept_id
                }
            }).then(function(response) {
                this.is_joined = response.data
            }.bind(this)).catch(function(error) {
                console.log(error);
            });
        }
    }

}
</script>
