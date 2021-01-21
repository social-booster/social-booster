<template>
<div>
    <h1 class="document-title">ウォッチ</h1>
    <hr>
    <div>
        <h2>ウォッチとは</h2>
        <p>ウォッチはブックマークと通知の２つを兼ねた機能です。</p>

        <h2>ウォッチの有効化</h2>
        <p>コンセプトの<b-icon icon="star" font-scale="1"></b-icon>をクリックする事でウォッチを有効化出来ます。</p>

        <h2>ブックマーク機能</h2>
        <p>左上の条件で「ウォッチ済みのコンセプト」を選ぶとウォッチ機能を有効化したコンセプトのみ表示されるようになります。</p>

        <h2>通知機能</h2>
        <p>ウォッチ機能を使用したコンセプトに紐付けなどの新しいアクションが加わるとメールを送付します。</p>
        <p>※通知機能は開発中です。<p>
    </div>
</div>
</template>

<script>
export default {
    head: {
        title: {
            inner: 'ウォッチ'
        },
        meta: [{
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
