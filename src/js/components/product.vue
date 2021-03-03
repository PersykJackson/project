<template>
  <div class='col-4 col-md-2 product'>
    <img class='rounded img-fluid product-img' :src="img"/>
    <p>{{name}}</p>
    <strong>{{cost}} грн</strong><br/>
    <button @click="toBasket(id)">В корзину</button>
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
      type: String,
      require: true
    },
    id: {
      type: String,
      require: true
    },
    description: {
      type: String,
      require: false
    }
  },
  methods: {
    toBasket(id)
    {
      sendPost('/basket/add', {id: id})
      reload()
    }
  }
}
</script>

<style scoped>

</style>