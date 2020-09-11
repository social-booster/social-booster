<template>
<div class="text-center mt-3">
    <b-form-checkbox switch size="lg" v-model="options.anonymous" :disabled="!is_verified">匿名モード</b-form-checkbox>
    <b-button v-b-toggle="'register-confirm'" class="mt-3 mb-3" variant="primary">登録する</b-button>
    <b-collapse id="register-confirm">
        <b-form-checkbox v-model="has_read_notes" switch size="sm" style="letter-spacing: 1.8px;">
            <span><a target="_blank" href="/document/notes">注意事項</a>を読んだ</span>
        </b-form-checkbox>
        <b-form-checkbox v-model="is_agreed_terms_of_use" switch size="sm">
            <span><a target="_blank" href="/document/terms-of-use">利用規約</a>に同意する</span>
        </b-form-checkbox>
        <b-button variant="danger" class="mt-3" @click="registration()" :disabled="!validation">
            本当に登録する
        </b-button>
    </b-collapse>
</div>
</template>

<script>
export default {
    data() {
        return {
            options: {
                anonymous: true
            },
            token: '',
            has_read_notes: false,
            is_agreed_terms_of_use: false
        }
    },
    mounted() {},
    computed: {
        register: function() {
            return this.$store.state.concept.register
        },
        create: function() {
            return this.$store.state.concept.create
        },
        select: function() {
            return this.$store.state.concept.select
        },
        is_verified: function() {
            return this.$store.state.auth.is_verified
        },
        is_cover_mode_enabled: function() {
            return this.$store.getters. ['concept/is_cover_mode_enabled']
        },
        layer_meta: function() {
            return this.$store.state.concept.layer_metas[this.create.layer]
        },
        validation_name: function() {
            if (!(this.create.layer === 5 || this.create.layer === 4)) {
                return true
            }
            return this.create.name.length > 0 && this.create.name.length <= this.layer_meta.name.limit
        },
        validation_content: function() {
            return this.create.content.length > 0 && this.create.content.length <= this.layer_meta.content.limit
        },
        validation_checkbox: function() {
            return this.has_read_notes && this.is_agreed_terms_of_use
        },
        validation: function() {
            if (this.select === Object && (this.register.mode === 'register' || this.is_cover_mode_enabled)) {
                return this.validation_name && this.validation_content && this.validation_checkbox
            }
            return this.validation_checkbox
        }
    },
    watch: {
        register: {
            handler: function() {
                if (this.is_verified) {
                    this.options.anonymous = false
                }
            },
            deep: true
        }
    },
    methods: {
        async recaptcha() {
            await this.$recaptchaLoaded()
            this.token = await this.$recaptcha('submit')
        },
        registration: async function() {
            await this.recaptcha()
            var new_concept = this.select === Object ? await this.conceptRegister(this.options.anonymous, this.create.layer, this.create.name, this.create.content, this.token) : this.select
            if (this.is_cover_mode_enabled) {
                this.coverRegister(
                    this.options.anonymous,
                    this.register.mode === 'upper' ? new_concept.id : this.register.base.id,
                    this.register.mode === 'upper' ? this.register.base.id : new_concept.id,
                    this.token
                )
            }
            this.$bvModal.hide('concept-register')
        },
        conceptRegister: async function(anonymous, layer, name, content, token) {
            return await axios.post('/ajax/insert/concept', {
                anonymous: anonymous,
                layer: layer,
                name: name,
                content: content,
                //token: token
            }).then(function(response) {
                return response.data
            }.bind(this)).catch(function(error) {
                if (error.response.data.errors.token[0] !== undefined) {
                    console.log(error.response.data.errors.token[0]);
                    alert(error.response.data.errors.token[0])
                } else {
                    alert('項目に問題があるか、プログラムに異常があるようです。')
                }
            }.bind(this));
        },
        coverRegister: function(anonymous, upper_concept_id, lower_concept_id, token) {
            axios.post('/ajax/insert/cover', {
                anonymous: anonymous,
                upper_concept_id: upper_concept_id,
                lower_concept_id: lower_concept_id,
                //token: token
            }).then(function(response) {
                return response.data
            }.bind(this)).catch(function(error) {
                if (error.response.data.errors.token[0] !== undefined) {
                    console.log(error.response.data.errors.token[0]);
                    alert(error.response.data.errors.token[0])
                } else {
                    alert('項目に問題があるか、プログラムに異常があるようです。')
                }
            }.bind(this));
        }
    }
}
</script>
