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
    products: {
      type: Array,
      require: true
    },
    pagesCount: {
      type: Number,
      require: true
    },
    numberOfPage: {
      type: Number,
      require: true,
      default: 0
    },
    categories: {
      type: Number,
      require: false
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
      let firstItem = this.numberOfPage * 12
      let lastItem = firstItem + 11
      if (productIndex >= firstItem && productIndex <= lastItem) {
        return true;
      }
      return false;
    },
    changePage(page) {
      this.numberOfPage = page;
    },
    disablePage(page) {
      if (page === this.numberOfPage) {
        return true
      }
      return false
    }
  },
  async created() {
    this.products = await this.getProducts()
    this.pagesCount = this.getCountPages()
    this.categories = localStorage.getItem('category').parseInt()
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