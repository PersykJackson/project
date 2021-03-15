<template>
  <div class="container" v-if="data">
    <div class="image">
      <img :src="data.img"/>
    </div>
    <div class="info">
      <p class="big">{{data.name}}</p>
      <p class="big">{{data.cost}} грн</p>
      <button name="toBasket" @click="toBasket">В корзину</button>
      <p class="big"><strong>Описание: </strong></p>
      <p class="description">{{data.description}}</p>
    </div>
  </div>
</template>

<script>
export default {
name: "product-page",
  data() {
    return {
      data: ''
    }
  },
  methods: {
    toBasket() {
      sendPost('/basket/add', {id: this.data.id})
    }
  },
  async created() {
    const get = window.location.search.slice(1).split('=')
    this.data = await sendPost('/products/getProduct', {id: get[1]})
    console.log(this.data)
  }
}
</script>

<style scoped>
  .container{
    display: grid;
    grid-template-columns: 60% 40%;
  }
  .image img{
    height: 500px;
    display: block;
    margin-right: auto;
    margin-left: auto;
  }
  .info{
    grid-row: 1/3;
    width: content-box;
    max-width: content-box;
    padding: 10px;
    text-align: center;
  }
  .big{
    font-size: 30px;
  }
  .description{
    word-wrap: break-word;
    max-width: content-box;
  }
</style>