<template>
<div class="form-group row mb-0">
    <div class="col-md-6 offset-md-4">
        <b-form-checkbox v-model="terms">
            <a target="_blank" href="/document/terms">利用規約</a>に同意する
        </b-form-checkbox>
        <b-form-checkbox v-model="privacy_policy">
          <a target="_blank" href="/document/privacy-policy">個人情報保護方針</a>に同意する
        </b-form-checkbox>
    </div>
    <div class="col-md-6 offset-md-4 mt-2">
        <b-button type="submit" variant="primary" :disabled="!register">
            登録
        </b-button>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            terms: false,
            privacy_policy: false
        }
    },
    computed: {
        register: function() {
            return this.terms && this.privacy_policy
        }
    }
}
</script>
