<template>
    <div>
        <div class="question text-center" v-resize-text>{{ text }}</div>
        <div>
            
            <p>
                <button type="button" class="btn btn-outline-secondary btn-sm" @click="playSound" v-if="sound"><icon icon="volume-up"></icon></button>
                <span class="form-text text-muted" style="display:inline">{{ instructions }}</span>
            </p>

            <textarea v-model="answer" required class="form-control my-answer" :placeholder="placeholder" :lang="language_code"></textarea>

            <div class="row mt-2 no-gutters">
                <div class="col mr-1">
                    <button type="button" class="btn btn-outline-secondary btn-block" @click="quit"><icon icon="times"></icon></button>
                </div>
                <div class="col-7">
                    <button type="submit" class="btn btn-success btn-block" @click="checkAnswer">Check Answer</button>
                </div>
                <div class="col mx-1">
                    <button type="button" class="btn btn-outline-secondary btn-block" @click="hint"><icon icon="question"></icon></button>
                </div>
                <div class="col ml-1">
                    <button type="button" class="btn btn-outline-secondary btn-block" @click="skip"><icon icon="arrow-right"></icon></button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import {Howl} from 'howler'

    export default {

        props: ['text', 'sound', 'instructions', 'placeholder', 'language_code'],

        mounted() {
            this.playSound();
        },

        data() {
            return {
                answer: null
            }
        },

        methods: {
            checkAnswer() {
                if ( (this.answer||'').trim() ) {
                    this.$emit('answer', this.answer);
                } else {
                    this.$toasted.info('Answer the question')
                }
            },
            quit() {
                this.$emit('quit')
            },
            skip() {
                this.$emit('skip')
            },
            hint() {
                this.$emit('hint')
            },
            playSound() {
                if ( this.sound ) {
                    ( new Howl({src:this.sound})).play();
                }
            }
        }
    };
</script>
<style scoped>
.my-answer {
    font-size: 2em;
}
</style>
