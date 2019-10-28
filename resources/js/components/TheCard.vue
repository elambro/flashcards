<template>
    <div>
        <small class="position-absolute"><a href="javascript:void(0)" @click="edit"><icon icon="pen"></icon></a></small>
        <TheQuestion 
            v-if="!response" 
            :text="sideA" 
            :sound="sideASound" 
            :instructions="instructions"
            :placeholder="placeholder"
            :language_code="sideBLanguageCode"
            @answer="checkAnswer"
            @skip="next"
            @quit="quit"
            @hint="hint"
            ></TheQuestion>
        <div v-else>


            <div class="question text-center" v-resize-text>{{ sideA }}</div>
            <textarea v-model="response" disabled readonly class="form-control my-answer"></textarea>

            <div class="mt-2">
                <div :class="['alert', alertClass]" role="alert">
                    <h4 class="alert-heading text-center">
                        {{ alertHeading }}
                        <strong v-if="card.score">{{ card.score }} %</strong>
                    </h4>
                    <hr>
                    <h5>
                        <button v-if="sideBSound" type="button" class="btn btn-outline-secondary btn-sm" @click="playAnswerText">
                            <icon icon="volume-up"></icon>
                        </button>
                        {{ sideB }}
                    </h5>

                    <div class="row no-gutters">
                        <div class="col mr-1">
                            <button class="btn btn-outline-secondary btn-block" @click="retry"><icon icon="redo"></icon></button>
                        </div>
                        <div class="col-8">
                            <button class="btn btn-primary btn-success btn-block" @click="next">Next</button>
                        </div>
                        <div class="col ml-1">
                            <button class="btn btn-outline-secondary btn-block" @click="quit"><icon icon="times"></icon></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import TheQuestion from './TheQuestion'
    import {Howl} from 'howler'
    import FuzzySet from 'fuzzyset.js'

    export default {

        components: {TheQuestion},

        soundSuccess: new Howl({src:'/audio/success.mp3'}),
        soundError: new Howl({src:'/audio/error.mp3'}),

        props: ['card'],

        side: Math.random() >= 0.5,

        fuzzyMin: 0.5,

        data() {
            return {
                response: null,
                hint_index: 0
            }
        },

        computed: {
            aKey() {
                return this.card.is_reversable ? (this.$options.side ? 1 : 2) : 1;
            },
            bKey() {
                return this.card.is_reversable ? (this.$options.side ? 2 : 1) : 2;
            },
            sideA() {
                return this.card['side_'+this.aKey];
            },
            sideB() {
                return this.card['side_'+this.bKey]
            },
            sideASound() {
                return this.card['side_'+this.aKey+'_sound_url'];
            },
            sideBSound() {
                return this.card['side_'+this.bKey+'_sound_url'];
            },
            sideALanguageCode() {
                return this.card['side_'+this.aKey+'_language_code'];
            },
            sideBLanguageCode() {
                return this.card['side_'+this.bKey+'_language_code'];
            },
            sideBInstructions() {
                return this.card['side_'+this.bKey+'_instructions'];
            },
            isExact() {
                if ( !_.isNil(this.fuzzyResult) ) {
                    return this.fuzzyResult === 1;
                }
            },
            isCorrect() {
                if ( !_.isNil(this.fuzzyResult) ) {
                    return this.fuzzyResult ? true : false;
                }
            },
            fuzzyResult() {
                return this.fuzzy(this.response);
            },
            sideBLanguage() {
                if (_.startsWith(this.sideBLanguageCode, 'en')) {
                    return 'English';
                } else if (_.startsWith(this.sideBLanguageCode, 'fr')) {
                    return 'French';
                } else if (_.startsWith(this.sideBLanguageCode, 'ru')) {
                    return 'Russian';
                } else if (_.startsWith(this.sideBLanguageCode, 'de')) {
                    return 'German';
                } else if (_.startsWith(this.sideBLanguageCode, 'es')) {
                    return 'Spanish';
                }
            },

            instructions() {
                return this.sideBInstructions || 'Translate into '+this.sideBLanguage;
            },
            placeholder() {
                if ( !this.hint_index ) {
                    return null;
                }
                // Get 25% of the word and show it as a placeholder
                var chars_to_show = Math.floor( 0.25*this.hint_index*this.sideB.length );
                return this.sideB.substring(0,chars_to_show);
            },

            alertClass() {
                if ( this.isExact ) {
                    return 'alert-success';
                } else if ( this.isCorrect ) {
                    return 'alert-warning';
                } else {
                    return 'alert-danger';
                }
            },
            alertHeading() {
                if ( this.isExact ) {
                    return 'Great job!';
                } else if ( this.isCorrect ) {
                    return 'Almost!';
                } else {
                    return 'Wrong!';
                }
            }
        },

        watch: {

        },

        methods: {
            checkAnswer(val) {
                this.response = val;
                this.$nextTick(() => {
                    this.isCorrect ? this.saveCorrectAnswer() : this.saveWrongAnswer();
                    this.playDing();
                })
            },
            saveCorrectAnswer() {
                this.$api.post('api/correct/'+this.card.id)
            },
            saveWrongAnswer() {
                this.$api.post('api/incorrect/'+this.card.id)
            },
            playDing() {
                if ( this.isCorrect ) {
                    this.$options.soundSuccess.play();
                } else {
                    this.$options.soundError.play();
                }
            },
            playAnswerText() {
                new Howl({src:this.sideBSound}).play()
            },
            next() {
                this.$emit('next')
            },
            quit() {
                this.$emit('quit')
            },
            retry() {
                this.response = null;
            },
            edit() {
                this.$emit('edit', this.card);
            },
            cleanString(str) {
                return str ? str.replace(/[^\w\s]|_/g, "").replace(/\s+/g, " ").toLowerCase().trim() : str;
            },
            fuzzy(str) {
                if ( str ) {
                    var a = FuzzySet([str.toLowerCase().trim()]);
                    var p = a.get(this.sideB.toLowerCase().trim(),null,this.$options.fuzzyMin);
                    return p ? p[0][0] : 0;
                }
            },
            hint() {
                this.hint_index = this.hint_index < 4 ? this.hint_index + 1 : 4;
            }
        }
    };
</script>
<style scoped>
.my-answer {
    font-size: 2em;
}
</style>