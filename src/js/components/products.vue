<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="products">
          <h3>Товары</h3><hr/>
          <div class="row">
      <product v-for="(f, i) in products" :key="i"
               :name="f.name"
               :cost="f.cost"
               :id="f.id"
               :img="f.img">
      </product>

  </div>
          <pagination
              :count-pages="countPages"
              @changePage="getProducts($event)">
          </pagination>
  </div>
  </div>
  </div>
  </div>
</template>

<script>
import Product from "./product.vue";
import Pagination from "./pagination.vue";
export default {
  name: "products",
  components: {Pagination, Product},
  data() {
    return {
      products: [],
      currentCategory: Number,
      countPages: 1,
      none: false
    }
  },
  methods: {
    async getProducts(page, category = false) {
      const data = {
        page: page,
        category: category
      }
      const products = await sendPost('/products/getProducts', data)
      this.products = products.page
      this.countPages = products.countPages
    }
  },
  async created() {
    const category = localStorage.getItem('category')
    if (category) {
      const products = await this.getProducts(1, category)
      localStorage.removeItem('category')
    } else {
      const products = await this.getProducts(1)
    }
  }
}
</script>

<style scoped>
.pagination {
  width: max-content;
  margin-left: auto;
  margin-right: auto;
}
.categories{
  cursor: pointer;
  text-align: center;
}
.categories ul{
  list-style: none;
  display: inline;
  text-align: center;
}
.categories ul li{
  padding: 5px;
  text-align: center;
}
.categories ul li:hover{
  background-color: orange;
  text-align: center;
}
.categories-enter-active, .categories-leave-active {
  transition: opacity .5s;
}
.categories-enter, .categories-leave-to {
  opacity: 0;
}
</style>