<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="categories">
          <ul>
            <li v-for="(val, index) in categories"><button @click="">{{val.name}}</button></li>
          </ul>
        </div>
        <div class="products">
          <h3>Товары</h3><hr/>
          <div class="row">
      <product v-for="(f, i) in products" :key="i"
               :name="f.name"
               :cost="f.cost"
               :id="f.id"
               :img="f.img"
               v-if="checkPage(i)">
      </product>
            <div class="pagination">
              <button v-for="(f, i) of pagesCount" :key="i" v-on:click="changePage(i)" v-bind:disabled="disablePage(i)">
                {{i+1}}
              </button>
            </div>
  </div>
  </div>
  </div>
  </div>
  </div>
</template>

<script>
import Product from "./product.vue";
export default {
  name: "products",
  components: {Product},
  props: {
  },
  data() {
    return {
      categories: [],
      products: [],
      pagesCount: Number,
      numberOfPage: 1,
      currentCategory: Number
    }
  },
  methods: {
    async getProducts() {
      return await sendPost('/products/all', 'all')
    },
    getCountPages() {
      const productsCount = this.products.length;
      return Math.ceil(productsCount / 12);
    },
    checkPage(productIndex) {
      let firstItem = (this.numberOfPage - 1) * 12
      let lastItem = firstItem + 11
      if (productIndex >= firstItem && productIndex <= lastItem) {
        return true;
      }
      return false;
    },
    changePage(page) {
      this.numberOfPage = page + 1;
    },
    disablePage(page) {
      if (page === this.numberOfPage) {
        return true
      }
      return false
    },
    checkCategory(categoryId) {
      if (this.currentCategory === 'undefined' || this.currentCategory === categoryId) {
        return true;
      }
      return false;
    }
  },
  async created() {
    this.products = await this.getProducts()
    this.pagesCount = this.getCountPages()
    this.categories = await sendPost('/main/categories')
  }
}
</script>

<style scoped>
.pagination {
  width: max-content;
  margin-left: auto;
  margin-right: auto;
}
</style>