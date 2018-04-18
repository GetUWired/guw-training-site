<template>
    <div>
        <div class="problemWrap">
            <hr>
            <div class="col-sm-10">
                <div class="form-group">
                    <select v-model="typeSelect" v-on:change="updateProblems" class="form-control">
                        <option value="0">Please select a type</option>
                        <option v-for="(type, index) in types" :value="type">{{ type
                            }}
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <select v-if="showProblems" v-model="currentProblem" class="form-control"
                            @change="getName()">
                        <option value="0">Please select a problem</option>
                        <option v-for="problem in currentOptions" :value="problem.value">{{ problem.label }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <input v-model="currentOrder" type="number" class="form-control" placeholder="Enter Order Number"/>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="button-group">
                    <!--<p class="btn btn-success btn-block">Save</p>-->
                    <p class="btn btn-primary btn-block" @click="addAnotherProblem">Add</p>
                </div>
            </div>
            <hr>
            <div class="col-sm-12 problemList">
                <ul class="list-unstyled">
                    <li v-for="problem in orderedProblems">{{ problem.order }}: <strong><u>{{ problem.type }}</u></strong>
                        &mdash; {{
                        problem.name.substring(0, 30) }}&hellip; &nbsp;
                        <span class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></span>
                    </li>
                </ul>
            </div>
        </div>

        <input type="hidden" name="problems" :value="JSON.stringify(this.chosenProblems)"/>
    </div>
</template>

<script>
    export default {
        name: "problem-set-builder",
        props: ['value', 'options', 'types'],
        data() {
            return {
                typeSelect: "0",
                showProblems: false,
                currentOrder: 0,
                currentProblem: 0,
                currentProblemName: "",
                currentOptions: {},
                chosenProblems: []
            }
        },
        computed: {
            orderedProblems: function() {
                return _.orderBy(this.chosenProblems, 'order')
            }
        },
        methods: {
            updateProblems() {
                this.showProblems = true
                let parent = this
                this.currentOptions = this.options.filter(function (elem) {
                    if (elem.type === parent.typeSelect) {
                        return elem
                    }
                })
            },
            addAnotherProblem() {
                this.chosenProblems.push({
                    problem: this.currentProblem,
                    name: this.currentProblemName,
                    order: this.currentOrder,
                    type: this.typeSelect
                })
            },
            getName() {
                console.log(event)
                this.currentProblemName = event.target.selectedOptions[0].innerHTML
            }
        }
    }
</script>

<style scoped>

</style>