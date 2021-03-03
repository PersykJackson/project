window.Vue = require('vue')

Vue.component('products', require('./components/products.vue').default)

const app = new Vue({
    el: '#app',
})