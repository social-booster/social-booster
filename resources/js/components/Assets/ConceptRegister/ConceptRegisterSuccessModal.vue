<template>
<b-modal id="successful-modal" hide-footer centered header-class="border-bottom-0">
    <div v-if="success_modal !== Object" class="text-center">
        <strong>ご協力感謝します！</strong>
        <div v-if="success_modal.register.mode === 'register'">
            <p class="mt-3">SocialBoosterが一つの脳だとするなら、いま投稿したコンセプトは記憶や体験を保管する細胞のようなものです。</p>
        </div>
        <div v-else>
            <p class="mt-3">SocialBoosterが一つの脳だとするなら、コンセプトは記憶や体験を保管する細胞であり、紐付けはそれらを結びつけるシナプスのようなものです。</p>
        </div>
        <p>ユーザーによってコンセプトと紐付けが評価されると、網の目状に接続されているコンセプトの中から最善策が浮かび上がってくるようになります…。</p>
        <div v-if="!success_modal.is_select">
            <b-button variant="primary" @click="link();closeModal()">
                登録したコンセプトを見る
            </b-button>
        </div>
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
