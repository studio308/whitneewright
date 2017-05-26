var Vue = require('vue');
var VueEventBus = require('vue-event-bus');
Vue.use(VueEventBus);
var VueResource = require('vue-resource');
Vue.use(VueResource);
import Categories from './Categories.vue';


new Vue({
    el: "#categories",
    components: {
        Categories
    }
});