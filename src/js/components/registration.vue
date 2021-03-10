<template>
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="errors" v-if="info">
          <li v-for="item in info">
            {{item}}
          </li>
        </div>
        <form id="form" class="form" method="post">
          <label for="name">Имя</label><br/>
          <input v-model="firstName" type="text" id="name" name="firstName" placeholder="Введите имя"/><br/>
          <label for="lastName">Фамилия</label><br/>
          <input v-model="lastName" type="text" id="lastName" name="lastName" placeholder="Введите фамилию"/><br/>
          <label for="login">Логин</label><br/>
          <input v-model="login" type="text" id="login" name="login" placeholder="Введите логин"/><br/>
          <label for="email">Почта</label><br/>
          <input v-model="email" type="email" id="email" name="email" placeholder="Введите почту"/><br/>
          <label for="password">Пароль</label><br/>
          <input v-model="password" type="password" id="password" name="password" placeholder="Введите пароль"/><br/>
          <label for="confirm">Подтвердие пароль</label><br/>
          <input v-model="confirm" type="password" id="confirm" name="confirm" placeholder="Проверка пароля"/><br/>
          <button @click="sendData" type="button">Зарегистрироваться</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
name: "registration",
  data() {
    return {
      info: false,
      firstName: '',
      lastName: '',
      login: '',
      email: '',
      password: '',
      confirm: ''
    }
  },
  methods: {
    async sendData() {
      const data = {
        firstName: this.firstName,
        lastName: this.lastName,
        login: this.login,
        email: this.email,
        password: this.password,
        confirm: this.confirm
      }
      const errors = await sendPost('/registration/register', data)
      if (errors) {
        this.info = errors
      } else {
       window.location.href = '/authentication/index'
      }
    }
  }
}
</script>

<style scoped>

</style>