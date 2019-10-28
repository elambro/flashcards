<template>
    <div>
        <CreateCard v-if="creatingCard" @cancel="creatingCard=false" @created="newCard"></CreateCard>
        <EditCard v-else-if="editingCard" :card="editingCard" @cancel="editingCard=false" @saved="editedCard"></EditCard>
        <TheGame v-else-if="playing" @quit="playing=false" @edit="editCard" :category_id="category_id" :language="language"></TheGame>
        
        <div v-else class="text-center mt-3">
            <InputCategory class="mb-2" v-model="category_id"></InputCategory>
            <InputLanguage class="mb-2" v-model="language"></InputLanguage>
            <button class="btn btn-primary btn-lg btn-block" @click="playing=true">Practice</button>
            <button class="btn btn-outline-secondary btn-lg btn-block" @click="creatingCard=true">New Card</button>
        </div>
    </div>
</template>

<script>

    import CreateCard from './CreateCard'
    import EditCard from './EditCard'
    import TheGame from './TheGame'
    import InputCategory from './Fields/InputCategory'
    import InputLanguage from './Fields/InputLanguage'


    export default {

        components: {CreateCard, EditCard, TheGame, InputCategory, InputLanguage},

        data() {
            return {
                creatingCard: false,
                editingCard: false,
                playing: false,
                category_id: null,
                language: null
            }
        },

        watch: {
            playing(val) {
                if (val) {
                    // hide navbar
                    document.getElementById('nav').style.display = 'none';
                } else {
                    // show navbar
                    document.getElementById('nav').style.display = 'flex';
                }
            }
        },

        mounted() {

            // this.$api.get('/api/cards')
            //     .then( response => {
            //         console.log(response);
            //     })
            //     .catch( err => {
            //         console.error(err); 
            //     })
        },

        methods: {
            newCard(card) {
                this.$toasted.success('The card was created');
                this.creatingCard=false;
            },
            editCard(card) {
                this.playing = false;
                this.editingCard = card;
            },
            editedCard(card) {

            }
        }
    };
</script>
