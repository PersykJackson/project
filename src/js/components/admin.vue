<template>
  <div class="container">
    <div class="toggle" @click="switchToggle">Переключить</div>
    <form v-if="toggle">
      <div v-if="result">{{result}}</div>
      <label for="name">Введите название</label><br/>
      <input v-model="name" id="name" type="text" name="name"/><br/>
      <label for="description">Введите описание продукта</label><br/>
      <textarea v-model="description" id="description" name="description"></textarea><br/>
      <label for="price">Введите цену</label><br/>
      <input v-model="cost" id="price" type="number" name="price"/><br/>
      <label for="category">Выберете категорию</label><br/>
      <select v-model="categoryId" id="category" name="category">
        <option v-for="category in categories" :value="category.id">{{category.name}}</option>
      </select><br/>
      <label class="fileButton" for="img">
        <div v-if="!image">
          Загрузите картинку
        </div>
        <div v-else>✓</div>
      </label><br/>
      <input @change="getImage" id="img" class="file" type="file" name="img"/>
      <button @click="send" type="button">Отправить</button>
    </form>
    <div class="deletePage" v-else>
      <ul>
        <li v-for="product in products">{{product.name}}<button @click="remove(product.id)">Удалить</button></li>
      </ul>
      <pagination
          :count-pages="countPages"
          @changePage="getProducts($event)">
        ></pagination>
    </div>
  </div>
</template>

<script>
import Pagination from "./pagination.vue";
export default {
name: "admin",
  components: {Pagination},
  data(){
    return {
      name: null,
      image: null,
      description: null,
      cost: null,
      discount: 0,
      categoryId: null,
      categories: null,
      result: false,
      toggle: true,
      products: null,
      countPages: 1,
      currentPage: 1
    }
  },
  methods: {
    getImage(event){
      let form = new FormData()
      form.append('file', event.target.files[0])
      form.append('name', 'eric')
      this.image = form
    },
    switchToggle(){
      this.toggle = !this.toggle
    },
    async remove(id){
      const result = await sendPost('/admin/remove', {id: id})
      await this.getProducts(this.currentPage)
    },
    async send(){
      const fileName = await sendFile('/admin/createProduct', this.image)
      const data = {
        name: this.name,
        imageName: fileName,
        categoryId: this.categoryId,
        description: this.description,
        cost: this.cost,
        discount: this.discount
      }
      if (await sendPost('/admin/createProduct', data)) {
        this.result = 'Товар успешно добавлен!'
        await this.getProducts(this.currentPage)
      } else {
        this.result = 'Ошибка'
      }
    },
    async getProducts(page, category = false) {
      const data = {
        page: page,
        category: category
      }
      this.currentPage = page
      const products = await sendPost('/products/getProducts', data)
      this.countPages = products.countPages
      this.products = products.page
    }
  },
  async created() {
    this.categories = await sendPost('/main/categories')
    await this.getProducts(this.currentPage)
  }
}
</script>

<style scoped>
  .container{
    text-align: center;
  }
  .container input, .container textarea, .container select{
    width: 40%;
  }
  .file{
    display: none;
  }
  .fileButton{
    padding: 10px;
    cursor: pointer;
    margin-top: 10px;
  }
  .fileButton:hover{
    background-color: orange;
  }
  .deletePage li{
    text-align: right;
  }
  .deletePage ul{
    margin-right: auto;
    margin-left: auto;
    width: max-content;
    list-style: none;
  }
  button{
    background-color: white;
  }
  button:hover{
    background-color: orange;
  }
  .toggle{
    cursor: pointer;
  }

</style>