var Vue = require('vue');
var VueEventBus = require('vue-event-bus');
Vue.use(VueEventBus);
var VueResource = require('vue-resource');
Vue.use(VueResource);

import AddEvent from './AddEvent.vue';


new Vue({
    el: "#event",
    components: {
        AddEvent
    }
});