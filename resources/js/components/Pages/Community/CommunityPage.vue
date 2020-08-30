<template>
<div>
    <h1>ダッシュボード</h1>
    <b-row>
        <b-col class="text-left" xl="3" lg="3" md="3">
            <router-link :to="'/community/' + concept_id + ''" class="mypage-menu">
                概要
            </router-link>
            <br>
            <router-link :to="'/community/' + concept_id + '/members'" class="mypage-menu">
                人員
            </router-link>
            <br>
            <router-link :to="'/community/' + concept_id + '/leave'" class="mypage-menu">
                脱退
            </router-link>
            <br>
            <ChannelList :concept_id="concept_id"  url="community" />
        </b-col>
        <b-col xl="9" lg="9" md="9">
            <router-view />
        </b-col>
    </b-row>
</div>
</template>

<script>
import ChannelList from "../../Assets/Channel/ChannelList"
export default {
    async beforeRouteEnter(to, from, next) {
        var response = await axios.get('/ajax/check/isCommunity', {
            params: {
                concept_id: to.params.concept_id
            }
        }).then(function(response) {
            return response.data
        }.bind(this)).catch(function(error) {
            console.log(error);
        });
        response ? next() : next('/concept/' + to.params.concept_id)
    },
    props: {
        concept_id: String
    },
    components: {
      ChannelList
    },
    mounted() {
    },
    methods: {
    }

}
</script>
