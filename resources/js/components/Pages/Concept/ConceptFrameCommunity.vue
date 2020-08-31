<template>
<span v-if="concept.layer === 5">
    <button class="concept-footer-button text-right" @click.prevent="$bvModal.show('community-' + concept.id);checkJoined();countParticipants()">
        <b-icon icon="people" font-scale="1.2"></b-icon>
    </button>
    <b-modal :id="'community-' + concept.id" hide-header hide-footer>
        <div class="text-center">
            <hr style="color: bla;background: #9788ff;height: 10px;border-radius: 10px;">
            <h2>{{concept.name}}</h2>
            <p>{{concept.content}}</p>
            <hr>
            <p style="color: #595959;font-size: 0.8rem;">只今の参加者数</p>
            <p style="font-size: 1.8rem;color: #424242;">{{participants}}</p>

            <b-button variant="primary" @click="is_joined ? $router.push('/community/' + concept.id) : joinCommunity()" :disabled="!is_verified">
                {{is_joined ? 'ダッシュボードを見る' : '参加する'}}
            </b-button>
        </div>
    </b-modal>
</span>
</template>

<script>
export default {
    data() {
        return {
            is_joined: false,
            participants: 0
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
        joinCommunity: function() {
            axios.post('/ajax/join/community', {
                concept_id: this.concept.id
            }).then(function(response) {
                console.log(response.data)
                this.checkJoined()
                this.countParticipants()
            }.bind(this)).catch(function(error) {
                console.log(error);
                alert('項目に問題があるか、プログラムに異常があるようです。')
            }.bind(this));
        },
        checkJoined: function() {
            axios.get('/ajax/check/joined', {
                params: {
                    concept_id: this.concept.id
                }
            }).then(function(response) {
                this.is_joined = response.data
            }.bind(this)).catch(function(error) {
                console.log(error);
            });
        },
        countParticipants: function() {
            axios.get('/ajax/query/Participants', {
                params: {
                    concept_id: this.concept.id
                }
            }).then(function(response) {
                this.participants = response.data
            }.bind(this)).catch(function(error) {
                console.log(error);
            });
        }
    }
}
</script>
