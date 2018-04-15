/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('../../../node_modules/bootstrap-sass/assets/javascripts/bootstrap/alert.js');

window.Vue = require('vue');

import swal from 'sweetalert';


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('hint-component', require('./components/HintsComponent.vue'));
Vue.component('type-component', require('./components/TypesComponent.vue'));
Vue.component('problem-set-builder', require('./components/ProblemSetBuilder'));

const app = new Vue({
    el: '#app',
    data: {
        hints: [{value: ''}]
    },
    methods: {
        addHint: function () {
            this.hints.push({value: ''});
        },
        updateCheckForProblem: function (res) {
            (res.data.status == 'true') ? 'true' : 'false';
        },
        toggleProblemCompletion: function (e) {
            axios.post('problem-completion', {pid: e.target.value}).then((res) => {
                this.updateCheckForProblem(res);
            }).catch((err) => console.error(err));
        }
    }
});

// new Vue({
//     el: '#app',
//     data: {
//         hints: [{value: ''}],
//         problem: []
//     },
//     methods: {
//         addHint: function() {
//             this.hints.push({value: ''});
//         },
//         updateCheckForProblem: function(res) {
//             (res.data.status == 'true') ? 'true' : 'false';
//         },
//         toggleProblemCompletion: function(e) {
//             axios.post('problem-completion', {pid: e.target.value}).then( (res) => {
//                 this.updateCheckForProblem(res);
//             }).catch( (err) => console.error(err));
//         }
//         // checkIfCompleted: function(value) {
//         //     console.log(this.problem);
//         //     return "Egg";
//         //     // axios.get('problem-completion-check/?pid=' +  e.target.value).then( (res) => {
//         //     //     // this.updateCheckForProblem(res);
//         //     //     return 'Chicken';
//         //     // });
//         // }
//     }
// });