<template>
<div class="text-center">
    <h1 class="mt-3">SocialBooster</h1>
    <p>独自の手法によって算出した優先順位を元に問題の解決を行う非同期協調SNSです</p>
    <hr>
    <div class="text-center">
        <div class="mt-3">
            <router-link to="/concepts/1">
                <b-button pill variant="dark">
                    皆の意見を見てみる
                </b-button>
            </router-link><br>
            <router-link to="/document/outline">
                <b-button class="mt-2" pill variant="light">
                    ドキュメントを見る
                </b-button>
            </router-link>
        </div>

        <b-row class="mt-4 text-center">
            <b-col xl="4" lg="4" md="4">
                <div class="front-card">
                    <h3>意見の発信</h3>
                    <p>職場、学校、社会、国に対して言いたいこと、提案してみたい事はありませんか？</p>
                    <p>SocialBoosterではあなたの身の回りの問題や、ふと思いついたアイデアなどを気軽に登録する事が出来ます。</p>
                </div>
            </b-col>
            <b-col xl="4" lg="4" md="4">
                <div class="front-card">
                    <h3>投票</h3>
                    <p>SocialBoosterのホーム画面ではみんなの意見を一覧することが出来ます。</p>
                    <p>もし、共感できるような問題や応援したいアイデアがあれば投票してみてください。</p>
                </div>
            </b-col>
            <b-col xl="4" lg="4" md="4">
                <div class="front-card">
                    <h3>優先順位の算出</h3>
                    <p>SocialBoosterは投票から問題やアイデアの優先順位を算出し、社会が取り組むべき課題を明らかにします。</p>
                    <p>ホーム画面では優先順位の高い意見から順に表示されています。</p>
                </div>
            </b-col>
        </b-row>
        <b-row class="mt-5">
            <b-col xl="4" lg="4" md="4">
                <a href='https://play.google.com/store/apps/details?id=tech.socialbooster.twa&pcampaignid=pcampaignidMKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1'>
                    <img class="google-play-badge" alt='Google Play で手に入れよう' src='https://play.google.com/intl/ja/badges/static/images/badges/ja_badge_web_generic.png' />
                </a>
            </b-col>
            <b-col xl="4" lg="4" md="4">
                <a href='//www.microsoft.com/store/apps/9PHK5LM9WK8F?cid=storebadge&ocid=badge'>
                    <img class="microsoft-store-badge" src='https://developer.microsoft.com/store/badges/images/Japanese_-get-it-from-MS.png' alt='Japanese badge' />
                </a>
            </b-col>
            <b-col xl="4" lg="4" md="4">
                <a href="https://github.com/syuumu200/social-booster" style="color: black;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="95" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
                        <path
                          d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z" />
                    </svg>
                </a>
            </b-col>
        </b-row>
    </div>
</div>
</template>

<script>
export default {
    head: {
        title: {
            inner: 'SocialBooster',
            separator: '-',
            complement: '議論をしない問題解決SNS'
        },
        meta: [{
                name: 'description',
                content: 'このSNSに議論をする機能はありません。独自に考案した”コンセプト””紐付け””投票”により問題の優先順位を算出、構造的な設計により、非同期的な問題解決を成し遂げます。'
            },
            {
                name: 'viewport',
                content: 'width=device-width,initial-scale=1.0,user-scalable=no'
            },
            {
                charset: 'utf-8'
            }
        ]
    }
}
</script>

<style>
.front-card {
    background: #f8f9fa;
    padding: 10px;
    border-radius: 5px;
    height: 100%;
}

.google-play-badge {
    width: 230px;
}

.microsoft-store-badge {
    width: 200px;
    height: 59px;
    margin-top: 15px;
    margin-bottom: 30px;
}

.github-badge {
    font-size: 100px;
    width: 95px;
    height: 100%;
}
</style>
