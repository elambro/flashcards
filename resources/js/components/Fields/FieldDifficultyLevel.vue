<template>
    <select 
        class="form-control" 
        v-model="value" 
        :disabled="disabled"
        :maxlength="schema.max"
        :placeholder="schema.placeholder"
        :readonly="schema.readonly">
        <option v-for="level in levels" :value="level.id" :key="level.id">{{ level.name }}</option>
    </select>
</template>

<script>

    import { abstractField } from 'vue-form-generator'

    export default {
        mixins: [abstractField],
        created() {
            this.fetchAll();
        },
        data() {
            return {
                levels: []
            };
        },
        methods: {
            fetchAll() {
                this.$api.all('/api/difficulty-levels')
                    .then( response => {
                        this.levels = response.data;
                    })
                    .catch( err => this.$toastCatch(err) )
            }
        }
    };
</script>
