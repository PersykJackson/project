<template>
  <div class="container">
    <h3>Спасибо за ваш заказ!</h3>
    <span>Наш оператор вскоре свяжется с вами, для уточнения деталей.</span><br/>
    <span>Ожидаемая дата доставки: {{orderInfo.date}}</span><br/>
    <span>К оплате: {{orderInfo.total}} грн</span><br/>
    <span class="long-text">Вы можете в любой момент получить
      необходимую вам информацию по вашему заказу через личный кабинет
      или позвонив к нам на горячую линию: 8 800 555 35 35</span><br/>
      <i class="small">P.S. Проще позвонить чем в кабинете узнавать</i><br/>
    <a id="link" href="/main/index">Вернуться на главную</a>
  </div>
</template>

<script>
export default {
name: "order-success",
  data() {
    return {
      orderInfo: Object
    }
  },
  created() {
    const orderInfo = JSON.parse(localStorage.getItem('orderInfo'))
    if (orderInfo) {
      this.orderInfo = orderInfo
      localStorage.removeItem('orderInfo')
    } else {
      window.location.href = '/main/index'
    }
  }
}
</script>

<style scoped>
  .container{
    width: 70%;
    text-align: center;
  }
  .long-text{
    word-wrap: break-word;
  }
  .small{
    font-size: 8px;
    margin-bottom: 5px;
  }
  .container a{
    display: block;
    padding: 10px;
    background-color: white;
    color: black;
    text-decoration: none;
    margin-left: auto;
    margin-right: auto;
    margin-top: 10px;
    width: max-content;
  }
  .container a:hover{
    background-color: orange;
  }
</style>