<template>
<div>
    <h3>{{channel.name}}</h3>
    <p>{{channel.description}}</p>
    <hr>
    <MessageList :channel_id="channel.id" />
    <MessageSender :channel_id="channel.id" />
</div>
</template>

<script>
import MessageList from "../Message/MessageList"
import MessageSender from "../Message/MessageSender"
export default {
    data() {
        return {
            channel: {}
        }
    },
    created() {
        this.queryChannel()
    },
    computed: {
        concept_id: function() {
            return this.$route.params.concept_id
        }
    },
    components: {
      MessageList,
      MessageSender
    },
    methods: {
        queryChannel: function() {
            axios.get('/ajax/query/channel', {
                params: {
                    concept_id: this.concept_id
                }
            }).then(function(response) {
                this.channel = response.data
            }.bind(this)).catch(function(error) {
                console.log(error);
            });
        }
    }
}
</script>
