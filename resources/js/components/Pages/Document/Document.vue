<template>
<div>
    <h1>ドキュメント</h1>
    <b-row>
        <b-col class="text-left" xl="3" lg="3" md="3">
            <div style="position: sticky;top: 0;">
                <div v-for="docu in documents">
                    <router-link :to="'/document/' + docu.slug" class="document-menu">
                        {{docu.title}}
                    </router-link>
                </div>
            </div>
        </b-col>
        <b-col xl="9" lg="9" md="9">
            <router-view />
        </b-col>
    </b-row>
</div>
</template>

<script>
export default {
    data() {
        return {
            documents: [{
                    slug: 'outline',
                    title: '概略'
                },
                {
                    slug: 'concept',
                    title: 'コンセプト'
                },
                {
                    slug: 'cover',
                    title: '紐付け'
                },
                {
                    slug: 'vote',
                    title: '投票'
                },
                {
                    slug: 'priority',
                    title: '優先順位の算出'
                },
                {
                    slug: 'intention',
                    title: '意図'
                },
                {
                    slug: 'supporters',
                    title: '運営協力者の募集'
                },
                {
                    slug: 'open-source',
                    title: 'オープンソース'
                },
                {
                    slug: 'notes',
                    title: '注意事項'
                },
                {
                    slug: 'terms-of-use',
                    title: '利用規約'
                },
                {
                    slug: 'privacy-policy',
                    title: '個人情報保護方針'
                }
            ]
        }
    }
}
</script>
