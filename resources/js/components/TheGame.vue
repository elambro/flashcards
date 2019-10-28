<template>
    <div class="justify-content-center">
        <Spinner :busy="fetching"></Spinner>
        <div class="card">
            <div class="card-body">
                <div v-if="gameEnded">
                    <h1 class="text-center">Good Job!</h1>
                    <button type="button" class="btn btn-block btn-primary" @click="finish">Finish</button>
                </div>
                <TheCard v-else-if="showCard && cards[index]" :card="cards[index]" @next="next" @quit="quit" @edit="edit"></TheCard>        
            </div>
        </div>
    </div>
</template>

<script>

    import TheCard from './TheCard';
    import Spinner from './Spinner';
    import {Howler} from 'howler'

    export default {

        components: {TheCard, Spinner},
        endpoint: 'api/play/cards',
        props: ['category_id', 'language'],

        mounted() {
            this.getSomeCards()
        },


        data() {
            return {
                cards   : [],
                fetching: false,
                index   : 0,
                nextUrl : null,
                done    : false,
                showCard: true,
                seed    : _.times(10, () => _.random(35)).join('')
            }
        },

        computed: {
            nextEndpoint() {
                return this.nextUrl ? '/'+this.nextUrl.replace(/^(?:\/\/|[^\/]+)*\//, "") : null;
            },
            gameEnded() {
                return this.done && this.index >= this.cards.length;
            },
            params() {
                var params = {};
                if ( this.category_id ) {
                    params.category_id = this.category_id;
                }
                if ( this.language ) {
                    params.language = this.language;
                }
                params.seed = this.seed;
                return params;
            }
        },

        watch: {
            index(val) {
                if (val > this.cards.length - 3 && !this.fetching) {
                    this.getMoreCards();
                }
            }
        },

        methods: {

            getSomeCards() {
                this.fetching = true;
                this.$api.get(this.$options.endpoint, this.params)
                    .then( ({data,links,meta,params}) => {
                        if ( !data.length ) {
                            this.$toasted.info('No cards were found.')
                            setTimeout(() => this.quit(), 1500);
                        }
                        this.cards = data;
                        this.nextUrl = (links||{}).next;
                    })
                    .finally(() => this.fetching = false )
                    .catch( err => this.$toastCatch(err) )
            },
            getMoreCards() {
                if ( !this.nextEndpoint ) {
                    this.done = true;
                    return;
                }

                // this.fetching = true;
                this.$api.get(this.nextEndpoint, this.params)
                    .then( ({data,links,meta,params}) => {
                        this.cards = _.concat(this.cards, data);
                        this.nextUrl = (links||{}).next;
                    })
                    .catch( err => this.$toastCatch(err) )
            },
            quit() {
                this.$emit('quit');
            },
            next() {
                // Reset "TheCard"
                this.showCard = false;
                this.index = this.index+1;
                this.$nextTick(() => {
                    this.showCard = true;
                });
            },
            edit(card) {
                this.$emit('edit', card);
            },
            finish() {
                this.index = 0;
                this.quit();
            }
        },
        beforeDestroy: function () {
            this.cards = [];
            Howler.unload();
        }
    };
</script>
