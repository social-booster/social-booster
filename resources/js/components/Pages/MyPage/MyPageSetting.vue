<template>
<div>
    <h2>設定</h2>
    <hr>
    <p>メールアドレス</p>
    <b-form-input v-model="my_user_data.email"></b-form-input>
    <div style="color: red;" v-for="(err) in errors['email']">
        {{err}}<br>
    </div>
    <p>ID</p>
    <b-form-input v-model="my_user_data.name"></b-form-input>
    <div style="color: red;" v-for="(err) in errors['name']">
        {{err}}<br>
    </div>
    <div class="mt-3">
        <a href="/password/reset">パスワードを再設定する</a><br>
    </div>
    <b-button class="mt-4" variant="success" @click="updateUser()">
        更新する
    </b-button>
</div>
</template>

<script>
export default {
    data() {
        return {
            errors: [],
            before: null
        }
    },
    mounted() {
    },
    computed: {
        my_user_data: function() {
            return this.$store.state.user.my_user_data
        }
    },
    methods: {
        updateUser: function() {
            axios.post('/ajax/update/user', {
                email: this.my_user_data.email,
                name: this.my_user_data.name
            }).then(function(response) {
                console.log(response.data)
                this.errors = []
                this.$store.dispatch('user/getMyUserData')
            }.bind(this)).catch(function(error) {
                this.errors = error.response.data.errors
                console.log(error.response.data.errors);
                alert('項目に問題があるか、プログラムに異常があるようです。')
            }.bind(this));
        }
    }
}
</script>
