<template>
<span>
    <button @click.prevent="openConceptVote(concept.id);getOneConceptVotes();getAllConceptVotes()" :id="'concept-v-' + concept.id" class="concept-footer-button" :disabled="!is_verified">
        <b-icon icon="heart" font-scale="1.2"></b-icon>
    </button>
    <b-popover :ref="'concept-v-' + concept.id" :target="'concept-v-' + concept.id" placement="top">
        <div class="text-center">
            <p class="mb-1">貴方の一票の価値</p>
            <p>{{all_concept_votes <= 0 ? 1 : 1 / all_concept_votes}}</p>
            <hr>
            <p class="mb-4">
                <span style="font-size: 1.5rem;">{{private_voting_rate}}</span>
                <span style="font-size: 1.3rem;">%</span>
            </p>
            <p class="mb-2" style="font-size: 0.6rem;">このコンセプトに対する投票回数は {{vote_sum}} です</p>
            <b-button-group>
                <b-button variant="light" @click="insertConceptVote(-1)" :disabled="vote_sum === 0">
                    <b-icon icon="dash" font-scale="1.2"></b-icon>
                </b-button>
                <b-button variant="light" @click="insertConceptVote(+1)">
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
        concept: Object
    },
    computed: {
        is_verified: function() {
            return this.$store.state.auth.is_verified
        },
        my_user_data: function() {
            return this.$store.state.user.my_user_data
        },
        all_concept_votes: function() {
            return this.$store.state.concept.all_concept_votes
        },
        private_voting_rate() {
            if (this.all_concept_votes <= 0) {
                return 0
            }
            return Math.round(this.vote_sum / this.all_concept_votes * 100, 2)
        }
    },
    watch: {
        concept: function(to, from) {
            if (this.$refs. ['concept-v-' + from.id] !== undefined) {
                this.$refs. ['concept-v-' + from.id].$emit('close')
            }
        }
    },
    created() {},
    mounted() {},
    methods: {
        openConceptVote: function(concept_id) {
            if (this.$refs. ['concept-v-' + this.concept.id] !== undefined) {
                this.$refs. ['concept-v-' + this.concept.id].$emit('open')
            }
        },
        getAllConceptVotes() {
            this.$store.dispatch('concept/getAllConceptVotes', this.my_user_data.id)
        },
        getOneConceptVotes() {
            axios.get('/ajax/query/OneConceptVotes', {
                params: {
                    user_id: this.my_user_data.id,
                    concept_id: this.concept.id
                }
            }).then(function(response) {
                this.vote_sum = response.data
            }.bind(this)).catch(function(error) {
                console.log(error);
            });
        },
        insertConceptVote: function(value) {
            axios.post('/ajax/insert/concept/vote', {
                user_id: this.my_user_data.id,
                value: value,
                concept_id: this.concept.id
            }).then(function(response) {
                this.vote_sum = response.data
                this.getAllConceptVotes()
            }.bind(this)).catch(function(error) {
                console.log(error);
                alert('項目に問題があるか、プログラムに異常があるようです。')
            }.bind(this));
        },

    }
}
</script>
