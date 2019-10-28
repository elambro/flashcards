<template>
    <select 
        class="form-control"
        :value="value"
        @input="input">
        <option value="" selected>Practice All Categories</option>
        <option v-for="level in levels" :value="level.id" :key="level.id">{{ level.depth_label || level.name }}</option>
    </select>
</template>

<script>

    export default {
        props: ['value'],

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
                this.$api.all('/api/categories')
                    .then( response => {
                        this.levels = response.data;
                    })
                    .catch( err => this.$toastCatch(err) )
            },
            input(evt) {
                this.$emit('input', evt.target.value)
            }
        }
    };
</script>
