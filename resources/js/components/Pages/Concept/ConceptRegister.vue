<template>
<div>
    <b-modal id="concept-register" hide-footer hide-header>
        <div class="text-center" style="display: grid;grid-template-columns: auto auto auto auto auto;">
            <b-button v-for="layer in [1,2,3,4,5]" :key="layer" :variant="create.layer === layer ? 'primary' : 'light'" size="sm" class="layer-button" @click="create.layer = layer" :disabled="!(next_layer === layer || register.mode === 'register')">
                {{layer | layerName}}
            </b-button>
        </div>
        <hr>
        {{create.layer | layerDescription}}
        <hr>
        <div v-if="this.register.base !== null">
            <p class="base-concept-name" v-if="this.register.base.name !== null">{{this.register.base.name}}</p>
            <p class="base-concept-content">{{this.register.base.content}}</p>
            <hr>
        </div>
        <div v-if="create.layer === 4 || create.layer === 5">
            <b-form-input type="text" v-model="create.name" :placeholder="layer_meta.name.placeholder" debounce="500" :disabled="select !== Object"></b-form-input>
            <div v-show="create.name.length >= layer_meta.name.limit" class="text-right" style="color: red;">
                {{layer_meta.name.limit - create.name.length}}
            </div>
        </div>
        <div class="mt-3">
            <b-form-textarea v-model.trim="create.content" :placeholder="layer_meta.content.placeholder" rows="6" debounce="500" :disabled="select !== Object">
            </b-form-textarea>
            <div v-show="create.content.length >= layer_meta.content.limit" class="text-right" style="color: red;">
                {{layer_meta.content.limit - create.content.length}}
            </div>
        </div>
        <div v-show="similarity.length > 0">
            <div class="text-center">
                <p class="mb-0 mt-2" style="color: #022544;">同じ内容のものはありませんか？</p>
                <p style="color: #022544;font-size: x-small;">殆ど同じ内容での紐付け、登録はおやめください。</p>
            </div>
            <div class="p-2" v-for="(simi,id) in similarity" :key="id">
                <p class="similarity-name">{{simi.name}}</p>
                <p class="similarity-content">{{simi.content}}</p>
                <div class="text-right" v-show="!(register.mode === 'register')">
                    <b-button :variant="select === simi ? 'dark' : 'light'" size="sm" @click.prevent="select === simi ? select = Object : select = simi" :disabled="Boolean(isCoverd(simi.id))">
                        {{select === simi ? '選択を解除する' : isCoverd(simi.id) ? '既に紐付けられています' : '紐付ける'}}
                    </b-button>
                </div>
                <hr>
            </div>
        </div>
        <div class="text-center mt-3">
            <b-form-checkbox switch size="lg" v-model="options.anonymous" :disabled="!is_verified">匿名モード</b-form-checkbox>

            <b-button v-b-toggle="'register-confirm'" class="mt-3 mb-3" variant="primary">登録する</b-button>
            <b-collapse id="register-confirm">
                <b-form-checkbox v-model="readed_notes" switch size="sm" style="letter-spacing: 1.8px;"><a target="_blank" href="/document/notes">注意事項</a>を読んだ</b-form-checkbox>
                <b-form-checkbox v-model="agreed_terms" switch size="sm"><a target="_blank" href="/document/terms">利用規約</a>に同意する</b-form-checkbox>
                <b-button variant="danger" class="mt-3" @click="registration()" :disabled="!validation">
                    本当に登録する
                </b-button>
            </b-collapse>
        </div>
    </b-modal>
</div>
</template>

<script>
export default {
    data() {
        return {
            select: Object,
            options: {
                anonymous: true
            },
            create: {
                layer: 1,
                name: '',
                content: ''
            },
            similarity: [],
            covers: [],
            token: '',
            readed_notes: false,
            agreed_terms: false


        }
    },
    async created() {
        //await this.recaptcha()
    },
    mounted() {
        this.$root.$on('bv::modal::hide', (bvEvent, modalId) => {
            if (modalId === 'concept-register') {
                this.$store.dispatch('concept/conceptRegister', {
                    mode: 'hide',
                    concept: null
                })
                this.create = {
                    layer: 1,
                    name: '',
                    content: ''
                }
                this.select = Object
                this.similarity = []
                this.covers = []
            }
        })
    },
    computed: {
        register: function() {
            return this.$store.state.concept.register
        },
        my_user_data: function() {
            return this.$store.state.user.my_user_data
        },
        is_verified: function() {
            return this.$store.state.auth.is_verified
        },
        cover_mode: function() {
            return this.register.mode === 'upper' || this.register.mode === 'lower'
        },
        layer_meta: function() {
            var metas = {
                1: {
                    content: {
                        placeholder: '社会での不平や不満、問題や課題について、「が問題だ、課題だ、不快だ、不満だ」という形で述べてください',
                        limit: 140
                    }
                },
                2: {
                    content: {
                        placeholder: '社会がどうあるべきかについて、「が欲しい、であるべき」という形で述べてください',
                        limit: 70
                    }
                },
                3: {
                    content: {
                        placeholder: '社会に対して提案したい工夫やアイデアについて、「をする」という形で述べてください',
                        limit: 35
                    }
                },
                4: {
                    name: {
                        placeholder: 'プロジェクトの名前です。',
                        limit: 20
                    },
                    content: {
                        placeholder: 'このプロジェクトが何をするものなのか可能な限り具体的に述べてください',
                        limit: 800
                    }
                },
                5: {
                    name: {
                        placeholder: 'コミュニティの名前です。',
                        limit: 10
                    },
                    content: {
                        placeholder: 'このコミュニティはどのような方向性を目指すかについて述べてください',
                        limit: 400
                    }
                }
            }
            return metas[this.create.layer]
        },
        next_layer: function() {
            if (!this.cover_mode) {
                return null
            }
            return this.register.base.layer + (this.register.mode === 'upper' ? +1 : -1)
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
            return this.readed_notes && this.agreed_terms
        },
        validation: function() {
            if (this.select === Object && (this.register.mode === 'register' || this.cover_mode)) {
                return this.validation_name && this.validation_content && this.validation_checkbox
            }
            return this.validation_checkbox
        }
    },
    watch: {
        register: {
            handler: function() {
                if (this.register.mode !== 'hide') {
                    this.$bvModal.show('concept-register')
                }
                if (this.cover_mode) {
                    this.create.layer = this.next_layer
                    this.selectCover(this.register.base.id, this.register.mode)
                }
                if (this.is_verified) {
                    this.options.anonymous = false
                }
            },
            deep: true
        },
        create: {
            handler: function() {
                if (this.register.mode !== 'hide') {
                    this.similaritySearch()
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
            var user_id = this.options.anonymous ? null : this.my_user_data.id
            var new_concept = this.select === Object ? await this.conceptRegister(user_id, this.create.layer, this.create.name, this.create.content, this.token) : this.select
            if (this.cover_mode) {
                this.coverRegister(
                    user_id,
                    this.register.mode === 'upper' ? new_concept.id : this.register.base.id,
                    this.register.mode === 'upper' ? this.register.base.id : new_concept.id,
                    this.token
                )
            }
            this.$bvModal.hide('concept-register')
        },
        conceptRegister: async function(user_id, layer, name, content, token) {
            return await axios.post('/ajax/insert/concept', {
                user_id: user_id,
                layer: layer,
                name: name,
                content: content,
                token: token
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
        coverRegister: function(user_id, upper_concept_id, lower_concept_id, token) {
            axios.post('/ajax/insert/cover', {
                user_id: user_id,
                upper_concept_id: upper_concept_id,
                lower_concept_id: lower_concept_id,
                token: token
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
        isCoverd: function(concept_id) {
            return this.covers.find(function(u) {
                if (u[(this.register.mode === 'upper' ? 'upper' : 'lower') + '_concept'] === undefined) {
                    return true
                }
                return u[(this.register.mode === 'upper' ? 'upper' : 'lower') + '_concept'].id === concept_id
            }.bind(this));
        },
        selectCover: function(concept_id, mode) {
            axios.get('/ajax/select/cover', {
                params: {
                    concept_id: concept_id,
                    mode: mode
                }
            }).then(function(response) {
                //console.log(response.data)
                this.covers = response.data
            }.bind(this)).catch(function(error) {
                console.log(error);
            });
        },
        similaritySearch: function() {
            axios.get('/ajax/serch/concept/similarity', {
                params: {
                    layer: this.create.layer,
                    content: this.create.content
                }
            }).then(function(response) {
                //console.log(response.data)
                this.similarity = response.data
            }.bind(this)).catch(function(error) {
                console.log(error);
            });
        }
    }
}
</script>

<style>
.similarity-name {
    color: #7b7b7b;
    font-size: 0.8rem;
}

.similarity-content {
    color: #7b7b7b;
    font-size: 0.75rem;
}

.base-concept-name {
    font-size: 0.95rem;
    margin-bottom: 3px;
}

.base-concept-content {
    font-size: 0.8rem;
}

.layer-button {
    font-size: 0.64rem
}
</style>
