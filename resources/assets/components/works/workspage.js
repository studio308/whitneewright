var Vue = require('vue');
var VueEventBus = require('vue-event-bus');
Vue.use(VueEventBus);
var VueResource = require('vue-resource');
Vue.use(VueResource);

import WorksPage from './WorksPage.vue';


new Vue({
    el: "#work",
    components: {
        WorksPage
    }
});