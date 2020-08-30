<template>
<div>
    <h1>Document</h1>
    <b-row>
        <b-col class="text-left" xl="3" lg="3" md="3">
            <router-link to="/document/concept" class="document-menu">
                コンセプト
            </router-link>
            <br>
            <router-link to="/document/cover" class="document-menu">
                紐付け
            </router-link>
            <br>
            <router-link to="/document/evaluation" class="document-menu">
                評価
            </router-link>
            <br>
            <router-link to="/document/priority" class="document-menu">
                優先順位の算出
            </router-link>
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

<style>
.document-menu {
    font-size: 0.95rem;
}
</style>
