<template>
    <select 
        class="form-control" 
        v-model="value" 
        :disabled="disabled"
        :maxlength="schema.max"
        :required="schema.required"
        :placeholder="schema.placeholder"
        :readonly="schema.readonly">
        <option v-for="opt in $options.options" :value="opt.id" :key="opt.id">{{ opt.name }}</option>
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

    import { abstractField } from 'vue-form-generator'

    export default {
        mixins: [abstractField],

        options: languages,

        data() {
            return {
                levels: []
            };
        },
    };
</script>