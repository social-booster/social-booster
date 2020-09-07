<template>
<div class="text-center">
    <h1 class="mt-3">SocialBooster</h1>
    <p>独自の手法によって算出した優先順位を元に問題の解決を行う非同期協調SNSです</p>
    <hr>
    <div class="text-center">
        <div style="margin-top: 3rem;">
            <router-link to="/concepts/1">
                <b-button class="p-3" variant="primary" pill size="lg" style="font-size: 1rem;">
                    コンセプトを見てみる
                </b-button>
            </router-link>
        </div>
        <b-row class="mt-4">
            <b-col xl="4" lg="4" md="4">
                <h2 class="mt-5 mb-3 section-name" style="border: none;"><strong>コンセプト</strong></h2>
                <p>SBのコンセプトは”全体を貫く基本的な観点・考え方”という意味ではなく、SBで扱われるコンテンツの事を指します</p>
                <router-link to="/document/concept" class="box-button">
                    <b-button variant="primary">
                        詳細を見る
                    </b-button>
                </router-link>
            </b-col>
            <b-col xl="4" lg="4" md="4">
                <h2 class="mt-5 mb-3 section-name" style="border: none;"><strong>紐付け</strong></h2>
                <p>コンセプト同士は網の目状に紐付けられています。紐付けによる再帰的な計算により優先順位の精度を向上させています</p>
                <router-link to="/document/cover" class="box-button">
                    <b-button variant="primary">
                        詳細を見る
                    </b-button>
                </router-link>
            </b-col>
            <b-col xl="4" lg="4" md="4">
                <h2 class="mt-5 mb-3 section-name" style="border: none;"><strong>投票</strong></h2>
                <p>ユーザーはコンセプトと紐付けに対して投票を行う事ができます。この投票を元にSBは優先順位を算出します</p>
                <router-link to="/document/vote" class="box-button">
                    <b-button variant="primary">
                        詳細を見る
                    </b-button>
                </router-link>
            </b-col>
        </b-row>
        <hr>
        <b-row class="text-center">
            <b-col></b-col>
            <b-col xl="4" lg="4" md="4">
                <h2 class="mt-5 mb-3 section-name" style="border: none;"><strong>運営協力</strong></h2>
                <p>SBの運営は大変です。テスト作業、ドキュメント整備、スパム対応、広報面での協力者を募集しています</p>
                <a target="_blank" href="https://discord.gg/KsUyhGY" class="box-button">
                    <b-button variant="primary">
                        Discord
                    </b-button>
                </a>
            </b-col>
            <b-col xl="4" lg="4" md="4">
                <h2 class="mt-5 mb-3 section-name" style="border: none;"><strong>開発協力</strong></h2>
                <p>残念ながら管理人は凡庸なアマチュアプログラマーです。SBでは開発メンバーの募集を随時行っています</p>
                <router-link to="/document/open-source" class="box-button">
                    <b-button variant="primary">
                        詳細を見る
                    </b-button>
                </router-link>
            </b-col>
            <b-col></b-col>
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
