<template>
<div class="mb-5">
    <b-button variant="light" href="" @click="selectCover(covers_select_mode === 'upper' ? 'lower' : 'upper')" :disabled="concept_layer === 1 || concept_layer === 5" block>
        {{ covers_select_button }}
    </b-button>
    <div v-for="cover in covers" :key="cover.id">
        <CoverFrame :cover="cover" :mode="covers_select_mode" />
    </div>
    <div v-show="covers.length === 0">
        <p class="text-center mt-4" style="font-size: 1.2rem;color: #717171;">紐付けがまだ無いようです</p>
        <p class="text-center mt-1" style="font-size: 0.8rem;color: #717171;">矢印ボタンから紐付けを行ってみましょう</p>
    </div>
</div>
</template>

<script>
import CoverFrame from "../Cover/CoverFrame"
export default {
    data() {
        return {
            covers: Array,
            covers_select_mode: 'upper'
        }
    },
    props: {
        concept_id: String,
        concept_layer: Number
    },
    watch: {
        concept_id: function() {
            this.covers = Object
            this.selectCover(this.covers_select_default)
        }
    },
    created() {
        this.selectCover(this.covers_select_default)
    },
    mounted() {
        this.$root.$on('bv::modal::hide', (bvEvent, modalId) => {
            if (modalId === 'concept-register') {
                this.selectCover(this.covers_select_mode)
            }
        })
    },
    components: {
        CoverFrame
    },
    computed: {
        covers_select_default: function() {
            if (this.concept_layer === 1 || this.concept_layer === 5) {
                return this.concept_layer === 1 ? 'upper' : 'lower'
            }
            return this.covers_select_mode
        },
        covers_select_button: function() {
            return this.covers_select_mode === 'upper' ? '下位の紐付けを参照する' : '上位の紐付けを参照する'
        }
    },
    methods: {
        selectCover: function(mode) {
            axios.get('/ajax/select/cover', {
                params: {
                    concept_id: this.concept_id,
                    mode: mode
                }
            }).then(function(response) {
                this.covers_select_mode = mode
                this.covers = response.data
            }.bind(this)).catch(function(error) {
                console.log(error);
            });
        }
    }
}
</script>
