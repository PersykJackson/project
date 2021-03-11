<template>
  <div class="container">
    <form>
      <label for="name">Insert product name</label><br/>
      <input v-model="name" id="name" type="text" name="name"/><br/>
      <label for="description">Insert description</label><br/>
      <textarea v-model="description" id="description" name="description"></textarea><br/>
      <label for="price">Insert price for product</label><br/>
      <input v-model="cost" id="price" type="number" name="price"/><br/>
      <label for="category">Select category</label><br/>
      <select v-model="categoryId" id="category" name="category">
        <option v-for="category in categories" :value="category.id">{{category.name}}</option>
      </select><br/>
      <label class="fileButton" for="img">Upload image</label><br/>
      <input @change="getImage" id="img" class="file" type="file" name="img"/>
      <button @click="send" type="button">Send</button>
    </form>
  </div>
</template>

<script>
export default {
name: "admin",
  data(){
    return {
      name: '',
      image: '',
      description: '',
      cost: null,
      discount: 0,
      categoryId: null,
      categories: null,
      result: null
    }
  },
  methods: {
    getImage(event) {
      let form = new FormData()
      form.append('file', event.target.files[0])
      form.append('name', 'eric')
      this.image = form
    },
    async send() {
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
      } else {
        this.result = 'Ошибка'
      }
    }
  },
  async created() {
    this.categories = await sendPost('/main/categories')
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
</style>