<template>
  <div class="container">
    <div class="info">
      <div class="errors" v-if="error">
        {{error}}
      </div>
      <form action="/order/new" method="post">
        <label for="phone" class="required">Номер телефона</label><br/>
        <input v-model="phone" type="tel" id="phone" name="phone" size="10" maxlength="10"/><br/>
        <label for="address" class="required">Ваш адрес</label><br/>
        <input v-model="address" type="text" id="address" name="address"/><br/>
        <label for="date" class="required">Дата доставки</label><br/>
        <input v-model="date" type="date" id="date" name="date" :min="minDate" :max="maxDate"/><br/>
        <label for="comment">Комментарий</label><br/>
        <textarea v-model="comment" id="comment" name="comment"></textarea><br/>
        <button v-if="basket.length" @click="sendData()" type="button">Заказать</button>
        <div v-else>В вашей корзине нет товаров!<br/><a href="/products/index">Вернуться к товарам</a></div>
      </form>
    </div>
    <div class="basket">
      <div class="product" v-for="product in basket">
        <div class="img"><img :src="product.item.img"/></div>
        <span>{{product.item.name}}</span>
        <span>{{product.amount}} x <strong>{{product.item.cost}} грн</strong></span>
      </div>
      <div class="total">
        Итого: <strong>{{total}} грн</strong>
      </div>
    </div>
  </div>
</template>

<script>
export default {
name: "order",
 data(){
  return {
    basket: false,
    total: 0,
    maxDate: Date,
    minDate: Date,
    phone: '',
    address: '',
    date: Date,
    comment: '',
    error: false
  }
 },
  methods: {
    getTotal(){
        let total = 0
        if (typeof this.basket === 'object') {
          for (let key in this.basket) {
            total += this.basket[key].item.cost * this.basket[key].amount
          }
        }
        return total
      },
    async sendData(){
      const data = {
        phone: this.phone,
        address: this.address,
        date: this.date,
        comment: this.comment
      }
      const errors = await sendPost('/order/new', data)
      if (!errors) {
        this.error = 'Не все обязательные поля заполнены'
      } else {
        window.location.href = '/main/index'
      }
    }
  },
  async created() {
    this.basket = await sendPost('/basket/getBasket')
    this.total = this.getTotal()
    this.date = new Date().toISOString().split('T')[0]
    this.minDate = this.date
    this.maxDate = new Date(new Date().setMonth(new Date().getMonth() + 1)).toISOString().split('T')[0]
  }
}
</script>

<style scoped>
  .container{
    display: grid;
    grid-template-columns: 60% 40%;
  }
  .info{
    text-align: center;
  }
  .info input, .info textarea{
    width: 60%;
    text-align: center;
  }
  .basket .product{
    width: 100%;
    display: grid;
    grid-template-columns: 30% 40% 30%;
    height: max-content;
  }
  .product img{
    width: 100%;
  }
  .total{
    grid-column: 1/4;
    text-align: center;
    font-size: 30px;
  }
  .required::after{
    content: " *";
    color: red;
  }
</style>