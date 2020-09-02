<template>
<div>
    <h2>アカウントの削除</h2>
    <hr>
    <p>本当に寂しいです。行ってしまわれるのですか…？</p>
    <b-button v-b-modal.delete-account variant="primary">
        アカウントを削除する
    </b-button>
    <b-modal id="delete-account" hide-footer hide-header>
        <div class="text-center">
            <strong>アカウントを削除する</strong>
            <p>登録されたメールアドレスを入力してください。</p>
            <b-form-input class="mt-2" v-model="email" type="email"></b-form-input>
            <b-button class="mt-3" variant="danger" @click="deleteUser()" :disabled="email !== my_user_data.email">
                アカウントを本当に削除する
            </b-button>
        </div>
    </b-modal>
</div>
</template>

<script>
export default {
    data() {
        return {
            email: ''
        }
    },
    computed: {
        my_user_data: function() {
            return this.$store.state.user.my_user_data
        }
    },
    methods: {
        deleteUser: function() {
            axios.post('/ajax/delete/user', null)
                .then(function(response) {
                    this.$router.push('/')
                    alert('さようなら…')
                }.bind(this)).catch(function(error) {
                    console.log(error);
                    alert('項目に問題があるか、プログラムに異常があるようです。')
                }.bind(this));
        }
    }
}
</script>
