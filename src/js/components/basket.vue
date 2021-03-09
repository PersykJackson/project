<template>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="basket">
          <ul class="basket-list">
            <li v-for="(product, key) in products">
            <div class='product'>
              <div class='grid'>
                <img class='rounded img-fluid product-img' :src="product.item.img"/>
                <div class='info'>
                  <h3>{{product.item.name}}</h3>
                  <span>{{product.item.description}}</span><br/>
                  <strong>{{product.item.cost * product.amount}}</strong>
                  <div class='counter'>
                    <button name='-' @click="action(product.item.id, decrement)">-</button>
                    <input type='text' :value="product.amount" size='3' name='count'/>
                    <button name='+' @click="action(product.item.id, increment)">+</button>
                  </div>
                </div>
                <button @click="action(product.item.id, unset)">Убрать</button>
              </div>
            </div>
          </li>
            <li>
              <div class="total">
                <strong>Итог: {{total}} грн</strong><br/>
                <button><a href="/order/index">Перейти к оформлению</a></button>
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
    products: []
  }
  },
  computed: {
    total: function () {
      let total = 0
      if (typeof this.products === 'object') {
        this.products.forEach(function (product) {
          total += product.item.cost * product.amount
        })
      }
      return total
    }
  },
  methods: {
    action(id, action) {
      sendPost('/basket/change', {
        action: action,
        id: id
      })
      this.getBasket()
    },
    async getBasket() {
      this.products = await sendPost('/basket/getBasket')
      this
    }
  },
  created() {
    this.getBasket()
  }
}
</script>

<style scoped>

</style>