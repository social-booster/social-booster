<template>
<div>
    <h1>ドキュメント</h1>
    <b-row>
        <b-col class="text-left" xl="3" lg="3" md="3">
            <nav style="position: sticky;top: 0;">
                <ul class="p-0">
                    <li v-for="docu in docs" style="list-style: none;">
                        <router-link :to="'/document/' + docu.slug" class="document-menu">
                            {{docu.title}}
                        </router-link>
                    </li>
                </ul>
            </nav>
        </b-col>
        <b-col xl="9" lg="9" md="9">
            <article class="mb-5">
                <router-view />
                <hr>
                <nav v-if="true" :style="'column-count: ' + (doc_prev === undefined ? 1 : 2) + ';'">
                    <div v-if="doc_prev !== undefined">
                        <span>←</span>
                        <router-link :to="'/document/' + doc_prev.slug">{{doc_prev.title}}</router-link>
                    </div>
                    <div v-if="doc_next !== undefined" class="text-right">
                        <router-link :to="'/document/' + doc_next.slug">{{doc_next.title}}</router-link>
                        <span>→</span>
                    </div>
                </nav>
            </article>
        </b-col>
    </b-row>
</div>
</template>

<script>
export default {
    computed: {
        docs: function() {
            return this.$store.state.document.documents
        },
        doc_now: function() {
            return this.docs.find(e => e.slug === this.$route.path.split('/')[2])
        },
        doc_prev: function() {
            return this.docs.find(e => e.page === this.doc_now.page - 1)
        },
        doc_next: function() {
            return this.docs.find(e => e.page === this.doc_now.page + 1)
        }
    }
}
</script>
