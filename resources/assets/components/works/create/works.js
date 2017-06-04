var Vue = require('vue');
var VueEventBus = require('vue-event-bus');
Vue.use(VueEventBus);
var VueResource = require('vue-resource');
Vue.use(VueResource);
import Works from './Works.vue';


new Vue({
    el: "#works",
    components: {
        Works
    }
});