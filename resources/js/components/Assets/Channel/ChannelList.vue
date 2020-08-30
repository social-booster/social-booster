<template>
    <div>
    <p class="channel-section">チャンネル</p>
    <div v-for="(channel,id) in channels" :key="id">
        <router-link class="channel-link" :to="'/' + url + '/' + concept_id + '/channel/' + channel.id">
            <span>#</span>
            <span>{{channel.name}}</span>
        </router-link>
    </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                channels: []
            }
        },
        props: {
            concept_id: String,
            url: String
        },
        created() {
            this.selectChannel()
            console.log(this.$route)
        },
        methods: {
            selectChannel: function() {
                axios.get('/ajax/select/channel', {
                    params: {
                        concept_id: this.concept_id
                    }
                }).then(function(response) {
                    this.channels = response.data
                }.bind(this)).catch(function(error) {
                    console.log(error);
                });
            }
        }
    }
</script>
<style>
.channel-section {
    color: #434444;
    font-size: 0.9rem;
    margin-top: 15px;
    border-bottom-width: 1px;
    border-bottom-style: solid;
    padding-bottom: 10px;
    border-bottom-color: #eaeaea;
}

.channel-link {
	color: #5a6882;
	text-decoration: none;
}
</style>
