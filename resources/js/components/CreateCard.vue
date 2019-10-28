<template>
    <div>
        <VueFormGenerator 
            :schema="schema" 
            :model="model" 
            :options="$options.formOptions"
            :isNewModel="true"
        ></VueFormGenerator>

        <div class="row no-gutters">
            <div v-if="model.side_1 && model.side_1_language_code && model.side_2_language_code" class="col mr-1">
                <button class="btn btn-outline-secondary btn-block" @click.prevent="autofill" :disabled="translating">Auto</button>
            </div>
            <div class="col-10">
                <button class="btn btn-primary btn-block" @click.prevent="post">Save</button>
            </div>
            <div class="col ml-1">
                <button class="btn btn-outline-secondary btn-block" @click.prevent="cancel"><icon icon="times"></icon></button>
            </div>
        </div>
    </div>
</template>

<script>

    import VueFormGenerator from 'vue-form-generator'
    import 'vue-form-generator/dist/vfg.css'
    import CardSchema from './../schema/card';

    // See https://github.com/googleapis/nodejs-translate#using-the-client-library
    // const {Translate} = require('@google-cloud/translate');
     // import {Translate} from '@google-cloud/translate';

    export default {

        components: {VueFormGenerator:VueFormGenerator.component},

        schema: CardSchema,

        name: 'CreateCard',

        model: {
            side_1              : null,
            side_2              : null,
            side_1_language_code: null,
            side_2_language_code: null,
            side_1_instructions : null,
            side_2_instructions : null,
            is_reversable       : false,
            difficulty_level_id : null,
            category_id: null,
        },

        formOptions: {
            validateAfterLoad   : true,
            validateAfterChanged: true,
            validateAsync       : true
        },

        computed: {
            schema() {
                return this.$options.schema;
            }
        },

        data() {
            return {
                saving: false,
                translating: false,
                model: {...this.$options.model}
            };
        },

        methods: {
            post() {
                this.saving = true;
                var data = _.omitBy({...this.model}, _.isNil);
                this.$api.post('api/cards', data)
                    .then( response => {
                        this.$emit('saved', response);
                        this.$emit('created', response);
                    })
                    .catch( err => this.$toastCatch(err) )
                    .finally( () => this.saving = false )
            },
            cancel() {
                this.$emit('cancel')
            },
            autofill() {
                if ( !this.model.side_1 || !this.model.side_1_language_code || !this.model.side_2_language_code ) {
                    this.$toasted.info('Fill languages and Side A before using autofill.');
                    return;
                }
                this.model.side_2 = 'Wait...';
                this.requestTranslation(this.model.side_1_language_code, this.model.side_2_language_code, this.model.side_1)
                    .then( text => this.model.side_2 = text );
            },
            async requestTranslation(source,target,q) {
                this.translating = true;
                return this.$api.post('api/translate', {
                    source,
                    target,
                    q
                })
                    .then(({text}) => text )
                    .catch( err => this.$toastCatch(err) )
                    .finally( () => this.translating = false );
            }
        }

    };
</script>
