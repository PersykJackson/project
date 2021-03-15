<template>
  <div class="container">
    <div class="links">
      <a id="history" href="/account/history">История заказов</a>
    </div>
    <div class="info">
      <p>Имя: {{info.firstName}}</p>
      <p>Фамилия: {{info.lastName}}</p>
      <p>Логин: {{info.login}}</p>
      <p>Почта: {{info.email}}</p>
      <p>Количество заказов: {{info.ordersCount}}</p>
    </div>
  </div>
</template>

<script>
export default {
name: "info",
  data() {
    return {
      info: Object
    }
  },
  methods: {
    async getInfo(){
      this.info = await sendPost('/account/info')
    }
  },
  async created() {
    await this.getInfo()
    const isAuth = await sendPost('/authentication/isAuth')
    if (!isAuth) {
      window.location.href = '/main/index'
    }
  }
}
</script>

<style scoped>
  .container{
    width: 100%;
    display: grid;
    grid-auto-columns: 20% 80%;
    text-align: center;
    height: 100%;
  }
  .links{
    grid-column: 1/2;
  }
  .info{
    grid-column: 2/3;
    text-align: left;
    margin: 0 auto;
  }
</style>