<template>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="basket">
          <ul class="basket-list">
            <li v-for="product in products">
            <div class='product'>
              <div class='grid'>
                <img class='rounded img-fluid product-img' :src="product.item.img"/>
                <div class='info'>
                  <h3>{{product.item.name}}</h3>
                  <span>{{product.item.description}}</span><br/>
                  <strong class="cost">{{product.item.cost * product.amount}}</strong>
                  <div class='counter'>
                    <button name='-' @click="action(product.item.id, decrement)">-</button>
                    <input type='text' :value="product.amount" size='3' name='count' disabled/>
                    <button name='+' @click="action(product.item.id, increment)">+</button>
                  </div>
                </div>
                <button class="deleteProduct" @click="action(product.item.id, unset)"></button>
              </div>
            </div>
          </li>
            <li>
              <div v-if="total" class="total">
                <strong>Итог: {{total}} грн</strong><br/>
                <a id="submit" href="/order/index"><button>Перейти к оформлению</button></a>
              </div>
              <div v-else>
                <p>Ваша корзина пуста</p>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
name: "basket",
  props: {
    unset: {
      default: 'unset'
    },
    increment: {
      default: 'increment'
    },
    decrement: {
      default: 'decrement'
    }
  },
  data() {
  return {
    products: {}
  }
  },
  computed: {
    total: function () {
      let total = 0
      if (typeof this.products === 'object') {
        for (let key in this.products) {
          total += this.products[key].item.cost * this.products[key].amount
        }
      }
      return total
    }
  },
  methods: {
    async action(id, action) {
      await sendPost('/basket/change', {
        action: action,
        id: id
      })
      let count = await sendPost('/basket/getCountProducts')
      this.$store.commit({
        type: 'set',
        count: count
      })
      await this.getBasket()
    },
    async getBasket() {
      this.products = await sendPost('/basket/getBasket')
    }
  },
  async created() {
    await this.getBasket()
    const isAuth = await sendPost('/authentication/isAuth')
    if (!isAuth) {
      window.location.href = '/main/index'
    }
  }
}
</script>

<style scoped>
  .total a{
    text-decoration: none;
    color: black;
  }
  .deleteProduct{
    position: relative;
    height: 33px;
    width: 33px;
    margin-top: 5px;
    margin-left: auto;
    margin-bottom: auto;
  }
  .deleteProduct::after, .deleteProduct::before{
    background-color: black;
    width: 2px;
    height: 33px;
    content: ' ';
  }
  .deleteProduct:before, .deleteProduct:after {
    position: absolute;
    bottom: 0;
    left: 16px;
    content: ' ';
    height: 33px;
    width: 2px;
    background-color: #333;
  }
  .deleteProduct:before {
    transform: rotate(45deg);
  }
  .deleteProduct:after {
    transform: rotate(-45deg);
  }
  .basket-list li{
    margin-top: 15px;
    margin-bottom: 15px;
  }
  .cost::after{
    content: ' грн';
  }
</style>