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
    }
  },
  methods: {
    async getProducts() {
      return await sendPost('/products/all', 'all')
    }
  },
  async created() {
    this.products = await this.getProducts()
  }
}
</script>

<style scoped>
@media (max-width: 767px) {
  .left-nav .col-md-4, .left-nav .col-1 {
    text-align: center;
    margin-right: auto;
    margin-left: auto;
  }
  .product button{
    align-items: center;
  }
}
.img-fluid{
  text-align: center;
  margin-left: auto;
  margin-right: auto;
}
.product-img{
  width: 100%;
  vertical-align: center;
  margin: 0 0 10px 0;
}
.product{
  text-align: center;
  margin-top: auto;
}
.product button{
  margin: 10px;
}
.products{
  margin-top: 20px;
}
.products button{
  background-color: white;
  border: none;
  padding: 10px;
}
.products button:hover{
  background-color: orange;
}
header{
  height: max-content;
}
</style>