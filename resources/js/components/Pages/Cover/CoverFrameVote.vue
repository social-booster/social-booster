<template>
<span>
    <button @click.prevent="openCoverVote(cover.id);getPrivateOneCoverVotes();getPrivateAllCoverVotes();" :id="'cover-v-' + cover.id" class="concept-footer-button" :disabled="!is_verified">
        <b-icon icon="heart" font-scale="1.1"></b-icon>
    </button>
    <b-popover :ref="'cover-v-' + cover.id" :target="'cover-v-' + cover.id" placement="top">
        <div class="text-center">
            <p class="mb-1">貴方の一票の価値</p>
            <p>{{all_cover_votes <= 0 ? 1 : 1 / all_cover_votes}}</p>
            <hr>
            <p class="mb-4">
                <span style="font-size: 1.5rem;">{{private_voting_rate}}</span>
                <span style="font-size: 1.3rem;">%</span>
            </p>
            <p class="mb-2" style="font-size: 0.6rem;">この紐付け対する投票回数は {{vote_sum}} です</p>
            <b-button-group>
                <b-button variant="light" @click="insertCoverVote(-1)">
                    <b-icon icon="dash" font-scale="1.2"></b-icon>
                </b-button>
                <b-button variant="light" @click="insertCoverVote(+1)">
                    <b-icon icon="plus" font-scale="1.2"></b-icon>
                </b-button>
            </b-button-group>
        </div>
    </b-popover>
</span>
</template>

<script>
export default {
    data() {
        return {
            vote_sum: 0
        }
    },
    props: {
        cover: Object
    },
    computed: {
        is_verified: function() {
            return this.$store.state.auth.is_verified
        },
        my_user_data: function() {
            return this.$store.state.user.my_user_data
        },
        all_cover_votes: function() {
            return this.$store.state.cover.all_cover_votes
        },
        private_voting_rate: function() {
            if (this.all_cover_votes <= 0) {
              return 0
            }
            return Math.round(this.vote_sum / this.all_cover_votes * 100, 2)
        }
    },
    created() {},
    mounted() {},
    methods: {
        openCoverVote: function(cover_vote) {
            this.$refs. ['cover-v-' + cover_vote].$emit('open')
        },
        getPrivateAllCoverVotes() {
            this.$store.dispatch('cover/getPrivateAllCoverVotes', {
                user_id: this.my_user_data.id,
                cover_id: this.cover.id
            })
        },
        getPrivateOneCoverVotes() {
            axios.get('/ajax/query/privateOneCoverVotes', {
                    params: {
                        user_id: this.my_user_data.id,
                        cover_id: this.cover.id
                    }
                })
                .then(function(response) {
                    this.vote_sum = response.data
                }.bind(this))
                .catch(function(error) {
                    console.log(error);
                });
        },
        insertCoverVote(value) {
            axios.post('/ajax/insert/cover/vote', {
                user_id: this.my_user_data.id,
                value: value,
                cover_id: this.cover.id
            }).then(function(response) {
                this.vote_sum = response.data
                this.getPrivateAllCoverVotes()
            }.bind(this)).catch(function(error) {
                console.log(error);
                alert('項目に問題があるか、プログラムに異常があるようです。')
            }.bind(this));
        }
    }
}
</script>
