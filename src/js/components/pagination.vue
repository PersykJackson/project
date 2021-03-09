<template>
  <div class="pagination">
    <button v-for="(f, i) of countPages" :key="i" @click="changePage(i)" :disabled="isDisabled(i)">
      {{i+1}}
    </button>
  </div>
</template>

<script>
export default {
name: "pagination",
  props: {
    countPages: {
      type: Number,
      require: true
    }
  },
  data() {
    return {
      currentPage: 1
    }
  },
  methods: {
    isDisabled(index){
      return index + 1 === this.currentPage
    },
    changePage(index) {
      this.currentPage = index + 1
      this.$emit('changePage', this.currentPage)
    }
  }

}
</script>

<style scoped>

</style>