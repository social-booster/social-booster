<template>
<div　style="display: grid;grid-template-columns: 11fr 1fr;">
    <b-form-textarea v-model="content" rows="3" max-rows="6" :disabled="!can_send"></b-form-textarea>
    <b-button variant="primary" @click="send()" :disabled="content.length === 0">
        送信
    </b-button>
    <div v-show="loaded">
        {{can_send ? '' : '発言権がありません。'}}
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            content: '',
            can_send: false,
            loaded: false
        }
    },
    props: {
        channel_id: String
    },
    watch: {
        channel_id: async function() {
            this.loaded = false
            await this.canUserSend()
            this.loaded = true
        }
    },
    methods: {
        send: function() {
            axios.post('/ajax/insert/message', {
                channel_id: this.channel_id,
                content: this.content
            }).then(function(response) {
                console.log(response.data)
                this.content = ''
            }.bind(this)).catch(function(error) {
                console.log(error);
                alert('項目に問題があるか、プログラムに異常があるようです。')
            }.bind(this));
        },
        canUserSend: async function() {
            await axios.get('/ajax/check/channel/CanUserSend', {
                params: {
                    channel_id: this.channel_id
                }
            }).then(function(response) {
                console.log(response.data)
                this.can_send = response.data
            }.bind(this)).catch(function(error) {
                console.log(error);
            });
        }
    }
}
</script>
