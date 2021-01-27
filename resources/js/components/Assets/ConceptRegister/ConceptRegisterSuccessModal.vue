<template>
<b-modal id="successful-modal" hide-footer centered header-class="border-bottom-0">
    <div v-if="success_modal !== Object" class="text-center">
        <strong>ご協力感謝します！</strong>
        <p class="mt-3">{{message}}</p>
        <p><a href="/document/concept" target="_blank">コンセプト</a>と<a href="/document/cover" target="_blank">紐付け</a>がユーザーによって評価されると複雑に接続されていたコンセプトが体系的に整理され、<a href="/document/priority" target="_blank">着手率</a>に沿って並べられます。</p>
        <b-button v-if="!success_modal.is_select" variant="primary" @click="link();closeModal()">
            登録したコンセプトを見る
        </b-button>
    </div>
</b-modal>
</template>

<script>
import mitt from "../../../mitt.js"
export default {
    data() {
        return {
            success_modal: Object
        }
    },
    mounted: function() {
        mitt.on('openSuccessModal', function(e) {
            this.$bvModal.show('successful-modal')
            this.success_modal = e
        }.bind(this));
    },
    computed: {
        message: function() {
            if (this.success_modal.register.mode === 'register') {
                return 'SocialBoosterが一つの脳だとするなら、いま登録したコンセプトは記憶や体験を保管するニューロンのようなものです。'
            }
            return 'SocialBoosterが一つの脳だとすると、コンセプトは記憶や体験を保管するニューロンであり、紐付けはそれらを結びつけるシナプスのようなものです。'
        }
    },
    methods: {
        link: function() {
            this.$router.push('/concept/' + this.success_modal.new_concept.id)
        },
        closeModal: function() {
            this.$bvModal.hide('successful-modal')
        }
    }
}
</script>
