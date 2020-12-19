<template>
<div>
    <div class="mb-3 mt-3">
        {{layerDescription(create.layer)}}
    </div>
</div>
</template>

<script>
export default {
    computed: {
        create: function() {
            return this.$store.state.concept.create
        },
    },
    methods: {
        layerDescription: function(layer) {
            var description = {
                1: 'ストレス層では問題や課題の発見、認識を行います。',
                2: 'ニーズ層ではどうしたいのかについて明確にします。',
                3: 'アイデア層は解決の方向性を提示します。',
                4: 'プロジェクト層では具体的な手段を計画します。',
                5: 'コミュニティ層では実際に行動する集団を組織します。',
            }
            return description[layer]
        }
    }
}
</script>
