<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 new-year-img">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="/images/happy-birthday.jpg" class="d-block w-100" alt="img">
          </div>
          <div class="carousel-item">
            <img src="/images/women-day.jpg" class="d-block w-100" alt="img">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"  data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"  data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
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
  strong{
    cursor: pointer;
  }
  .carousel button{
    z-index: 0;
  }
</style>