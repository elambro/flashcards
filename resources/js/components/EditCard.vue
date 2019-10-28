<script>

    import CreateCard from './CreateCard'

    export default {

        extends: CreateCard,

        name: 'EditCard',

        props: ['card'],

        data() {
            return {
                saving: false,
                model: {...this.$options.model, ..._.pick(this.card, _.keys(this.$options.model) ) }
            };
        },

        methods: {
            post() {
                this.saving = true;
                var data = _.omitBy(_.omit(this.model, ['category_id']), _.isNil);
                this.$api.put('api/cards/'+this.card.id, data)
                    .then( response => {
                        this.$emit('saved', model);
                        this.$emit('updated', model);
                    })
                    .catch( err => this.$toastCatch(err) )
                    .finally( () => this.saving = false )
            },
            cancel() {
                this.$emit('cancel')
            }
        }

    };
</script>
