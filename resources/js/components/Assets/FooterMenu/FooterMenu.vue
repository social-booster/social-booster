<template>
<footer class="container-sm">
    <nav class="global-footer-menu">
        <router-link to="/concepts/1">
            <b-icon icon="house" class="global-footer-menu-item"></b-icon>
        </router-link>
        <router-link to="/document/outline">
            <b-icon icon="file-earmark-text" class="global-footer-menu-item"></b-icon>
        </router-link>
        <router-link to="/mypage" v-if="is_verified">
            <b-icon icon="gear" class="global-footer-menu-item"></b-icon>
        </router-link>
    </nav>
</footer>
</template>

<script>
export default {
    computed: {
        is_verified: function() {
            return this.$store.state.auth.is_verified
        }
    }
}
</script>

<style>
.global-footer-menu {
    display: grid;
    grid-auto-flow: column;
    text-align: center;
    position: fixed;
    bottom: 0px;
    background: white;
    border-top-color: #dfdfdf;
    border-top-width: 1px;
    border-top-style: solid;
    padding-top: 5px;
    padding-bottom: 5px;
    right: 0px;
    left: 0px;
}

.global-footer-menu-item {
    width: 25px;
    height: 25px;
    color: #4d4d4d;
}
</style>
