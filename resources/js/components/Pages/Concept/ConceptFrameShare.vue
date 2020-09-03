<template>
<span>
    <button class="concept-footer-button" @click.prevent="$bvModal.show('share-' + concept.id)">
        <b-icon icon="share" font-scale="1"></b-icon>
    </button>
    <b-modal ref="share" :id="'share-' + concept.id" hide-footer hide-header centered>
        <div class="text-left">
            <strong>共有</strong>
            <div class="mt-4">
                <b-button variant="light" @click="Twitter()">
                    <img src="/images/sns-icons/icon_017880_256.png" alt="Twitter" title="Twitter" style="height: 70px;">
                </b-button>
                <b-button variant="light" @click="FaceBook()">
                    <img src="/images/sns-icons/icon_017850_256.png" alt="FaceBook" title="FaceBook" style="height: 70px;">
                </b-button>
            </div>
            <div v-clipboard:copy="share_link" style="font-size: 0.8rem;padding: 21px;background: #dfdfdf;border-radius: 5px;margin-top: 40px;cursor: pointer;">
                <span>{{share_link}}</span><span class="float-right">コピー</span>
            </div>
        </div>
    </b-modal>
</span>
</template>

<script>
export default {
    data() {
        return {}
    },
    props: {
        concept: Object
    },
    computed: {
        share_link: function() {
            return location.origin + '/concept/' + this.concept.id
        }
    },
    methods: {
        Twitter: function() {
            var url = "https://twitter.com/intent/tweet?text=" + this.concept.content + "&url=" + this.share_link + "&hashtags=" + 'SocialBooster' + "&via=" + 'SocialBooster';
            window.open(url, '_blank');
        },
        FaceBook: function() {
            var url = encodeURIComponent(this.share_link);
            window.open("https://www.facebook.com/sharer/sharer.php?u=" + url + '&hashtag=SocialBooster', '_blank');
        }
    }
}
</script>
