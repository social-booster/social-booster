<template>
<div>
    <b-modal id="verify-email" hide-footer hide-header no-close-on-backdrop no-close-on-esc>
        <div class="text-center">
            <p class="mt-5 mb-5"><strong>メール認証が完了していません！</strong></p>
            <p class="mb-3">現在ではまだ非匿名モード、投票、チャットといった機能がご利用になれません。</p>
            <b-button class="mb-5" variant="primary" @click="sendMail()" :disabled="sended_mail">
                認証メールを再送する
            </b-button>
            <p style="font-size: 14px;color: #535353;">※迷惑メールフォルダに入っている可能性もあります。</p>
        </div>
    </b-modal>
</div>
</template>

<script>
export default {
    data() {
        return {
            sended_mail: false
        }
    },
    computed: {
        is_login: function() {
            return this.$store.state.auth.is_login
        },
        is_login_loaded: function() {
            return this.$store.state.auth.is_login_loaded
        },
        is_verified: function() {
            return this.$store.state.auth.is_verified
        },
        is_verified_loaded: function() {
            return this.$store.state.auth.is_verified_loaded
        },
        loaded: function() {
            return this.is_login_loaded && this.is_verified_loaded
        }
    },
    watch: {
        loaded: function() {
            if (this.is_login && !this.is_verified) {
                this.$bvModal.show('verify-email')
            }
        }
    },
    methods: {
        sendMail: async function() {
            this.sended_mail = true
            await axios.post('/email/resend', null)
                .then(function(response) {
                    console.log(response.data)
                    alert('認証メールを送信しました')
                }.bind(this)).catch(function(error) {
                    console.log(error);
                    alert('項目に問題があるか、プログラムに異常があるようです。')
                }.bind(this));
            this.$bvModal.hide('verify-email')
        }
    }
}
</script>
