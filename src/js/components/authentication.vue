<template>
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="errors" v-if="errors">
          <li>
            {{errors}}
          </li>
        </div>
        <div v-else></div>
        <form method="post">
          <label for="login">Логин</label><br/>
          <input v-model="login" type="text" id="login" name="login" placeholder="Введите логин"/><br/>
          <label for="pass">Пароль</label><br/>
          <input v-model="password" type="password" id="pass" name="password" placeholder="Введите пароль"/><br/>
          <button type="button" @click="sendData">Вход</button>
          <a href="/registration/index">Регистрация</a>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
name: "authentication",
  data() {
  return {
    errors: false,
    login: '',
    password: ''
  }
  },
  methods: {
    async sendData()
    {
      const answer = await sendPost('/authentication/login', {
        login: this.login,
        password: this.password
      })
      if (answer === true) {
        window.location.href = '/main/index'
      } else {
        this.errors = answer
      }
    }
  }
}
</script>

<style scoped>
  .errors * {
    color: red;
    list-style: none;
    font-weight: 300;
  }
</style>