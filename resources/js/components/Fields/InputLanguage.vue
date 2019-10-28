<template>
    <select 
        class="form-control"
        :value="value"
        @input="input"
        placeholder="Practice All Languages">
        <option value="" selected>Practice All Languages</option>
        <option v-for="level in $options.options" :value="level.id" :key="level.id">{{ level.name }}</option>
    </select>
</template>

<script>

    const languages = [
        { id: "en-US", name: "English" },
        { id: "ru-RU", name: "Russian" },
        { id: "fr-FR", name: "French" },
        { id: "de-DE", name: "German" },
        { id: "es-MX", name: "Spanish" }
    ];

    export default {
        props: ['value'],

        options: languages,

        methods: {
            input(evt) {
                this.$emit('input', evt.target.value)
            }
        }
    };
</script>
