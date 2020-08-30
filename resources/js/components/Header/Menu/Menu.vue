<template>
<!-- Right Side Of Navbar -->
<span v-if="is_login_loaded">
    <b-navbar-nav class="ml-auto" v-if="is_login">
        <span v-show="is_verified_loaded">
            <b-button v-show="!is_verified" class="nav-link" variant="link" @click="sendMail()" :disabled="sended_mail" style="font-size: 0.8rem;padding: 0.7rem;">
                認証メールを再送する
            </b-button>
        </span>
        <b-nav-item-dropdown :text="my_user_data.name" right>
            <b-dropdown-item href="/concepts/1">タイムライン</b-dropdown-item>
            <b-dropdown-item href="/mypage">マイページ</b-dropdown-item>
            <b-dropdown-item @click="$store.dispatch('auth/logout')">ログアウト</b-dropdown-item>
        </b-nav-item-dropdown>
    </b-navbar-nav>
    <b-navbar-nav v-else>
        <b-nav-item href="/login">ログイン</b-nav-item>
        <b-nav-item href="/register">新規登録</b-nav-item>
    </b-navbar-nav>
</span>
<span v-else>
      <b-spinner variant="secondary" style="height: 1.5rem;width: 1.5rem;" label="Loading..."></b-spinner>
</span>
</template>

<script>
export default {
    data() {
        return {
          sended_mail: false
        }
    },
    computed: {
        my_user_data: function() {
            return this.$store.state.user.my_user_data
        },
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
        }
    },
    methods: {
        sendMail: function() {
            this.sended_mail = true
            axios.post('/email/resend', null)
            .then(function(response) {
                console.log(response.data)
                alert('認証メールを送信しました')
            }.bind(this)).catch(function(error) {
                console.log(error);
                alert('項目に問題があるか、プログラムに異常があるようです。')
            }.bind(this));
        }
    }
}
</script>
