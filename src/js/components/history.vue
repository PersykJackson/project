<template>
  <div class="container">
    <div id="search" class="search">
      <input v-model="searchData" id="search_data"/>
      <select v-model="searchType" id="search_type" name="search_type">
        <option value="phone" selected>По номеру</option>
        <option value="address">По адресу</option>
        <option value="date">По дате</option>
      </select>
      <select v-model="sortType" id="sort_type" name="sort_type">
        <option value="id" selected>default</option>
        <option value="date">Дата</option>
      </select>
      <button @click="searchOrders()">Поиск</button>
    </div>
    <table v-if="orders" id="table">
      <caption>Ваши заказы</caption>
        <tr>
          <td>Телефон</td>
          <td>Дата</td>
          <td>Коммантарий</td>
          <td>Адрес</td>
          <td>Товары</td>
        </tr>
      <tr v-for="order in orders">
        <td>{{order.phone}}</td>
        <td>{{order.date}}</td>
        <td>{{order.comment}}</td>
        <td>{{order.address}}</td>
        <td>
          <ol>
            <li v-for="product in order.products">
              {{product.name}} - {{product.amount}} шт
            </li>
          </ol>
        </td>
      </tr>
    </table>
    <div v-else>
      Загрузка...
    </div>
    <pagination
        :count-pages="countPages"
        @changePage="searchOrders($event)"
    >
    </pagination>
  </div>
</template>

<script>
import Pagination from "./pagination.vue";
export default {
name: "history",
  components: {Pagination},
  data() {
    return {
      orders: false,
      searchData: '',
      sortType: '',
      searchType: '',
      countPages: 1
    }
  },
  methods: {
    async searchOrders(page = 1)
    {
      const data = {
        search: this.searchData,
        sort: this.sortType,
        type: this.searchType,
        page: page
      }
      const answer = await sendPost('/account/search', data)
      this.orders = answer.page
      this.countPages = answer.countPages
      }
    },
  created() {
    this.sortType = 'id'
    this.searchType = 'phone'
    this.searchOrders()
  }
}
</script>

<style scoped>

</style>