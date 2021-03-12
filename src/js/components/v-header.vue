<template>
  <nav>
    <ul>
      <div class="container">
        <div class="row">
          <div class="col-md-7 col-lg-8">
            <div class="row justify-content-start left-nav">
              <div class="col-1 col-md-4 col-lg-1">
                <li class="nav-item"><a href="/main/index">MaxiMarket</a></li>
              </div>
              <div class="col-1 col-md-4 col-lg-1">
                <li class="nav-item"><a href="/products/index">Товары</a></li>
              </div>
            </div>
          </div>
          <div class="col-md-5 col-lg-4">
            <div class="row justify-content-center" v-if="auth">
                <div class='col-1 col-md-auto admin_panel' v-if="access">
                  <li class='nav-item'><a href="/admin/index">Админ панель</a></li>
                </div>
                <div class='col-1 col-md-auto'>
                  <li class='nav-item'><a href='/basket/index'>Корзина</a></li>
                </div>
              <div class='col-1 col-md-auto'>
                <li class='nav-item'><a href='/account/index'>Аккаунт</a></li>
              </div>
              <div class='col-1 col-md-auto'>
                <li class='nav-item'><a href='/authentication/logout'>Выход</a></li>
              </div>
            </div>
            <div class="row justify-content-center" v-else>
              <div class='col-1 col-md-auto'>
              <li class='nav-item'><a href='/authentication/index'>Авторизация</a></li></div>
          </div>
        </div>
      </div>
      </div>
    </ul>
  </nav>
</template>

<script>
export default {
name: "v-header",
  props: {
  },
  data() {
    return {
      auth: Boolean,
      access: false
    }
  },
  methods: {
    async isAuth() {
      return await sendPost('/Authentication/isAuth')
    }
  },
  async created() {
    this.auth = await this.isAuth()
    this.access = await sendPost('/account/isAdmin')
  }
}
</script>

<style scoped>

</style>