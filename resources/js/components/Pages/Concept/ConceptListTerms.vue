<template>
<div>
    <b-button v-b-modal.sliders variant="light">
        <b-icon icon="sliders" font-scale="1.2"></b-icon>
    </b-button>

    <b-modal id="sliders" hide-footer hide-header>
        <b-form-checkbox class="mt-1" v-model="terms.my_concept_only">
            自分で投稿したコンセプト
        </b-form-checkbox>
        <b-form-checkbox class="mt-1" v-model="terms.voted_concepts">
            投票済みのコンセプト
        </b-form-checkbox>
        <b-form-checkbox class="mt-1" v-model="terms.joined_community">
            加入済みのコミュニティ
        </b-form-checkbox>
        <b-form-checkbox class="mt-1" v-model="terms.watching_concepts">
            ウォッチ中のコンセプト
        </b-form-checkbox>
        <b-form-group class="mt-1" label="除外">
            <b-form-checkbox-group stacked v-model="terms.exclusion_layer">
                <b-form-checkbox value="1">ストレス</b-form-checkbox>
                <b-form-checkbox value="2">ニーズ</b-form-checkbox>
                <b-form-checkbox value="3">アイデア</b-form-checkbox>
                <b-form-checkbox value="4">プロジェクト</b-form-checkbox>
                <b-form-checkbox value="5">コミュニティ</b-form-checkbox>
            </b-form-checkbox-group>
        </b-form-group>
        <b-button class="mt-3" variant="primary" @click="search();$bvModal.hide('sliders')">
            反映する
        </b-button>
    </b-modal>
</div>
</template>

<script>
export default {
    data() {
        return {
            terms: {
                my_concept_only: false,
                voted_concepts: false,
                joined_community: false,
                watching_concepts: false,
                exclusion_layer: []
            }
        }
    },
    methods: {
        search: function() {
            this.$store.commit('concept/setTerms', {
                my_concept_only: this.terms.my_concept_only,
                voted_concepts: this.terms.voted_concepts,
                joined_community: this.terms.joined_community,
                watching_concepts: this.terms.watching_concepts,
                exclusion_layer: this.terms.exclusion_layer
            })
        }
    }
}
</script>
