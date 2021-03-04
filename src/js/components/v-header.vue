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
              <div class="col-1 col-md-4 col-lg-1 drop-trigger">
                <li class="nav-item"><a class="" href="#">Категории</a></li>
                <div class="drop-down">
                  <ul>
                    <li v-for="(object, index) in categories" :key="index">
                      <a :href="categoryUrl + object.id">{{object.name}}</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-5 col-lg-4">
            <div class="row justify-content-center" v-if="isAuth">
                <div class='col-1 col-md-auto'>
                  <li class='nav-item'><a href='/basket/index'>Корзина</a></li>
                </div>
              <div class='col-1 col-md-auto'>
                <li class='nav-item'><a href='/account/history'>Аккаунт</a></li>
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
    categories: {
      type: Array,
      require: false
    },
    categoryUrl: {
      type: String,
      require: true,
      default: "/products/index?category="
    },
    isAuth: {
      type: Boolean,
      require: true
    }
  },
  methods: {
    toProductsWithCategory(categoryId) {
      localStorage.setItem('category', categoryId)
    }
  },
  async created() {
    this.categories = await sendPost('/main/categories');
    this.isAuth = await sendPost('/Authentication/isAuth')
  }
}
</script>

<style scoped>

</style>