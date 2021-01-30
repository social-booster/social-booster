<template>
<DocumentFrame title="オープンソース">
    <h2>開発者の募集</h2>
    <p>開発協力者を募集しております。</p>
    <p>コミュニティやプロジェクト内部にあるチャット機能など、改善できる余地は多分にありますので、機能の提案ついでにプルリクエスト等して頂けると幸いです。</p>
    <p>issueでのバグ報告、機能の提案などもお待ちしております！</p>
    <h2>利用</h2>
    <p>SocialBoosterの機能はこのサイトで利用する事もできますが、MITライセンスで公開されているためどなたでも自由に複製・カスタマイズする事が出来ます。</p>
    <p>市、町、区といった規模でこのシステムを運用したり、社内SNSとして活用する事もできます。</p>
    <a target="_blank" href="https://github.com/syuumu200/social-booster">Githubはこちら</a>
    <h2>フレームワーク</h2>
    <p>当サイトは以下のフレームワーク、ライブラリ、ツールを用いて開発されました。</p>
    <ul>
        <li>Laravel</li>
        <li>Vue.js</li>
        <li>Vuex</li>
        <li>Vue-router</li>
    </ul>
</DocumentFrame>
</template>

<script>
import DocumentFrame from "../../Assets/DocumentFrame/DocumentFrame"
export default {
    components: {
        DocumentFrame
    },
    head: {
        title: {
            inner: 'オープンソース'
        },
        meta: [{
                name: 'description',
                content: '問題解決を非同期的に解決するSNS、SocialBoosterはオープンソースです。'
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
