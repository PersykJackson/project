<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 new-year-img">
        <img class="img-fluid rounded mx-auto d-block" src="/images/new-year-image.jpg" alt="oops"/>
      </div>
      <div class="col-12 popular">
        <div class="products">
          <h3>Популярные товары</h3><hr/>
          <div class="row">
            <product v-for="(product, index) in products" :key="index"
                      :name="product.name"
                      :cost="product.cost"
                      :id="product.id"
                      :img="product.img">
            </product>
          </div>
        </div>
        <div class="categories">
          <div class="row">
            <h3>Популярные категории</h3><hr/>
            <div class='col-4 col-md-2 category' v-for="category in categories">
                <img class='rounded img-fluid category-img' :src="category.img" alt="category-img"/>
                <strong>{{category.name}}</strong><br/>
                <button @click="goTo(category.id)">Перейти</button>
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
name: "v-main",
  components: {Product},
  data() {
    return {
      products: Array,
      categories: Array
    }
  },
  methods: {
    goTo(id) {
      localStorage.setItem('category', id)
      window.location.href = '/products/index'
    }
  },
  async created() {
    this.products = await sendPost('/products/getTopProducts')
    this.categories = await sendPost('/main/categories')
  }
}
</script>

<style scoped>
  .category button {
    margin-left: auto;
    margin-right: auto;
  }
</style>