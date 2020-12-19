<template>
<div ref="scroll" style="overflow-y: scroll;height: 600px;">
    <div v-for="(mes,id) in messages" ref="messages">
        <p style="color: #00000091;"><strong>{{mes.user.name}}</strong></p>
        {{mes.content}}
        <hr>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            messages: []
        }
    },
    props: {
        channel_id: String
    },
    watch: {
        channel_id: async function() {
            await this.selectMessage()
            this.scroller()
        }
    },
    mounted: function() {
        var channel = Echo.channel('message');
        channel.listen('.message', function(data) {
            this.messages.push(data.message)
            this.scroller()
        }.bind(this));
    },
    methods: {
        selectMessage: async function() {
            await axios.get('/ajax/select/message', {
                params: {
                    channel_id: await this.channel_id
                }
            }).then(function(response) {
                this.messages = response.data
            }.bind(this)).catch(function(error) {
                console.log(error);
            });
        },
        scroller: function() {
            if (this.$refs.messages !== undefined && this.$refs.messages[this.$refs.messages.length - 1] !== undefined) {
                Vue.nextTick().then(function() {
                    this.$refs.scroll.scrollTop = this.$refs.messages[this.$refs.messages.length - 1].offsetTop
                }.bind(this))
            }
        }
    }
}
</script>
