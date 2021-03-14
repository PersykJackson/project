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
              <div class="nav-products col-1 col-md-4 col-lg-1">
                <li class="nav-item"><a href="/products/index">Товары</a></li>
                <div class="categories">
                  <li v-for="category in categories" @click="goTo(category.id)">{{category.name}}</li>
                </div>
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
      access: false,
      categories: Object
    }
  },
  methods: {
    async isAuth() {
      return await sendPost('/Authentication/isAuth')
    },
    goTo(id) {
      localStorage.setItem('category', id)
      window.location.href = '/products/index'
    }
  },
  async created() {
    this.auth = await this.isAuth()
    this.access = await sendPost('/account/isAdmin')
    this.categories = await sendPost('/main/categories')
  }
}
</script>

<style scoped>
  .nav-products .categories{
    display: none;
    opacity: 0;
    position: absolute;
    top: 15px;
    list-style: none;
    cursor: pointer;
    background-color: white;
    padding: 10px;
  }
  .nav-products .categories li{
    padding: 10px;
  }
  .nav-products .categories li:hover{
    background-color: orange;
  }
  .nav-products:hover .categories{
    display: block;
    opacity: 100%;
    transition: 1s;
    z-index: 1;
  }
</style>