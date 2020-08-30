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
                <h2 class="mt-5 mb-3 section-name"><strong>コンセプト</strong></h2>
                <p>SBのコンセプトは”全体を貫く基本的な観点・考え方”という意味ではなく、SBで扱われるコンテンツの事を指します</p>
                <router-link to="/document/concept" class="box-button">
                    <b-button variant="primary">
                        詳細を見る
                    </b-button>
                </router-link>
            </b-col>
            <b-col xl="4" lg="4" md="4">
                <h2 class="mt-5 mb-3 section-name"><strong>紐付け</strong></h2>
                <p>コンセプト同士は網の目状に紐付けられています。紐付けによる再帰的な計算により優先順位の精度を向上させています</p>
                <router-link to="/document/cover" class="box-button">
                    <b-button variant="primary">
                        詳細を見る
                    </b-button>
                </router-link>
            </b-col>
            <b-col xl="4" lg="4" md="4">
                <h2 class="mt-5 mb-3 section-name"><strong>投票</strong></h2>
                <p>ユーザーはコンセプトと紐付けに対して投票を行う事ができます。この投票を元にSBは優先順位を算出します</p>
                <router-link to="/document/vote" class="box-button">
                    <b-button variant="primary">
                        詳細を見る
                    </b-button>
                </router-link>
            </b-col>
        </b-row>
    </div>
</div>
</template>

<script>
export default {
    mounted() {}
}
</script>

<style>
.section-name {
    color: #555;
}
</style>
