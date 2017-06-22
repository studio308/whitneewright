var Vue = require('vue');
var VueEventBus = require('vue-event-bus');
Vue.use(VueEventBus);
var VueResource = require('vue-resource');
Vue.use(VueResource);

import EventsPage from './EventsPage.vue';


new Vue({
    el: "#events",
    components: {
        EventsPage
    }
});