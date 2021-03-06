window.Vue = require('vue')

Vue.component('products', require('./components/products.vue').default)
Vue.component('v-header', require('./components/v-header.vue').default)
Vue.component('basket', require('./components/basket.vue').default)
Vue.component('authentication', require('./components/authentication.vue').default)

const app = new Vue({
    el: '#app'
})