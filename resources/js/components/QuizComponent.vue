<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Online ExaminAtion
                        <span class="float-right">{{questionIndex}}/{{questions.length}}</span>
                    </div>
                    <div class="card-body">
                        <span class="float-right" style="color:red;">10:00</span>
                        <div v-for="(question, index) in questions" :key="index">
                            <div v-show="index === questionIndex">
                                {{question.question}}
                            <ol>
                            <li v-for="choice in question.answers" :key="choice.id">
                                <label>
                                    <input type="radio">
                                    {{choice.answer}}
                                </label>
                            </li>
                        </ol>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-success float-right" @click="prev()">Prev</button>
                        <button class="btn btn-success" @click="next()">Next</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['quizid', 'quizQuestions', 'hasQuizPlayed', 'times'],
        data() {
            return {
                questions: this.quizQuestions,
                questionIndex: 0,
            }
        },
        methods: {
            next(){
                this.questionIndex++
            },
            prev(){
                this.questionIndex--
            },
        },
    }
</script>
