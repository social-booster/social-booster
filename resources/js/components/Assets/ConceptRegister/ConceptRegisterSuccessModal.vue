<template>
<b-modal id="successful-modal" hide-footer centered>
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
            <router-link :to="'/concept/' + success_modal.new_concept.id">
                <b-button variant="primary" href="">
                    投稿したコンセプトを見る
                </b-button>
            </router-link>
        </div>
    </div>
</b-modal>
</template>

<script>
export default {
    mounted: function() {},
    computed: {
        success_modal: function() {
            return this.$store.state.concept.success_modal
        }
    },
    watch: {
        success_modal: function() {
            this.$bvModal.show('successful-modal')
        }
    }
}
</script>
