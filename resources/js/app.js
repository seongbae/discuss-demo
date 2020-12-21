require('./bootstrap');

require('alpinejs');

window.Vue = require('vue');

import { BootstrapVue } from 'bootstrap-vue'
Vue.component('thread', require('./components/Thread.vue').default);
Vue.component('reply', require('./components/Reply.vue').default);
Vue.component('channel-subscribe', require('./components/ChannelSubscribe.vue').default);
Vue.use(BootstrapVue)
