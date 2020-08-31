<template>
<div>
    <h1>マイページ</h1>
    <b-row>
        <b-col class="text-left" xl="3" lg="3" md="3">
            <router-link to="/mypage" class="mypage-menu">
                参加コミュニティ
            </router-link>
            <br>
            <router-link to="/mypage/setting" class="mypage-menu">
                設定
            </router-link>
            <br>
        </b-col>
        <b-col xl="9" lg="9" md="9">
            <router-view />
        </b-col>
    </b-row>
</div>
</template>

<script>
export default {
    mounted() {}
}
</script>
