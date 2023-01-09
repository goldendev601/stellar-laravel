require('./bootstrap');




/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import vSelect from 'vue-select'
window.Vue = require('vue');
Vue.component('App', require('./components/App.vue').default);
Vue.component('MakeInquire', require('./components/MakeInquire').default);
Vue.component('MemberList', require('./components/MemberList').default);
Vue.component('ConversationsSection', require('./components/ConversationsSection').default);
Vue.component('ChatMessage', require('./components/ChatMessage').default);
Vue.component('AddNewConversation', require('./components/AddNewConversation').default);
Vue.component('loader', require('./components/loader').default);
Vue.component('LinkPreview', require('@ashwamegh/vue-link-preview').default);
Vue.component('v-select', vSelect)
// Vue.component('LinkPreview', require('link-prevue').default);


// Vue.use(VueMoment, {
//     moment,
// })
Vue.use(require('vue-moment'));


const app = new Vue({
    el: '.vue-container',
});
// new Vue({
//     el: '#make-inquire-popup',
//     components: {
//         'inquire': require('./components/makeInquire'),
//     }
// });
