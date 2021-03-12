window.Vue = require('vue')

Vue.component('products', require('./components/products.vue').default)
Vue.component('v-header', require('./components/v-header.vue').default)
Vue.component('basket', require('./components/basket.vue').default)
Vue.component('authentication', require('./components/authentication.vue').default)
Vue.component('v-main', require('./components/v-main.vue').default)
Vue.component('registration', require('./components/registration.vue').default)
Vue.component('history', require('./components/history.vue').default)
Vue.component('info', require('./components/info.vue').default)
Vue.component('order', require('./components/order.vue').default)
Vue.component('product-page', require('./components/product-page.vue').default)
Vue.component('admin', require('./components/admin.vue').default)
Vue.component('order-success', require('./components/orderSuccess.vue').default)

const app = new Vue({
    el: '#app'
})