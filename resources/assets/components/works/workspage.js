import WorksPage from './WorksPage.vue';

var Vue = require('vue');
var VueEventBus = require('vue-event-bus');
Vue.use(VueEventBus);
var VueResource = require('vue-resource');
Vue.use(VueResource);

new Vue({
    el: "#work",
    components: {
        WorksPage
    }
});