<template>
<div>
    <h1 class="document-title">オープンソース</h1>
    <hr>
    <div>
      <h2>開発のご協力</h2>
      <p>当サイトは開発協力者を募集しております。</p>
      <p>コミュニティやプロジェクト内部にあるチャット機能など、改善できる余地は多分にありますので、機能の提案ついでにプルリクエスト等して頂けると幸いです。</p>
      <p>issueでのバグ報告、機能の提案などもお待ちしております！</p>
      <h2>ご自由にお使い下さい</h2>
      <p>当システムはSNSとして公開されておりますが、もともとは組織内の問題解決や課題設定を半自動化する為に考案されたものです。</p>
      <p><a target="_blank" href="https://github.com/syuumu200/social-booster">Github</a>に公開されておりますので、ご自由にカスタマイズしてお使い下さい。</p>
      <h2>商用利用</h2>
      <p>商用利用についてはご相談ください。</p>
      <h2>フレームワーク</h2>
      <p>当サイトはLaravel,Vue,Vuex,Vue-router等のフレームワークを用いて開発されました。</p>
    </div>
</div>
</template>

<script>
export default {
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
