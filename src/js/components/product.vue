<template>
  <div class='col-4 col-md-2 product'>
    <a :href="href">
    <img class='rounded img-fluid product-img' :src="img" alt="product-img"/>
    <p>{{name}}</p>
    </a>
    <strong>{{cost}} грн</strong><br/>
    <button @click="toBasket">В корзину</button>
  </div>
</template>

<script>
export default {
name: "Product",
  props: {
    name: {
      type: String,
      require: true
    },
    img: {
      type: String,
      require: true
    },
    cost: {
      type: Number,
      require: true
    },
    id: {
      type: Number,
      require: true
    },
    description: {
      type: String,
      require: false
    }
  },
  data() {
    return {
      href: '/products/product?id=' + this.id
    }
  },
  methods: {
    async toBasket() {
      sendPost('/basket/add', {id: this.id})
      this.$store.commit({
        type: 'set',
        count: await sendPost('/basket/getCountProducts')
      })
    }
  }
}
</script>

<style scoped>
  .product a{
    text-decoration: none;
    color: black;
  }
  .product:hover a{
    color: orange;
  }
</style>