<template>
  <div class="home">

    <Header title="Produktu pievienošana/ labošana" />

    <form  @submit.prevent="formSubmit">
      <h3 class="error-message">{{ this.$store.state.error }}</h3>
      <input type="text" v-model="title" placeholder="Produkta nosaukums" required>
      <button>Pievienot</button>
    </form>
  </div>
</template>

<script>
import Header from "../components/Header";
export default {
  name: "AddProduct",
  components: {
    Header
  },
  data: function () {
    return {
      title: null
    }
  },
  mounted: function () {
    if(this.$store.state.userToken == null){
      this.$router.push('/login')
    }
  },
  methods: {
    formSubmit: function () {
      this.$store.dispatch('add_product',  { id: this.$store.state.product_update_id ,title: this.title } )
      this.$router.push('/')
    }
  }
}

</script>

<style>
form {
  display: flex;
  max-width: 300px;
  width: 100%;
  flex-direction: column;
  gap: 20px;
  margin-top: 10%;
  margin-right: auto;
  margin-left: auto;
}

form > input, form > button{
  border: 1px solid black;
  padding: 10px;
  background-color: transparent;
}

form > button {
  cursor: pointer;
  padding: 17px;
}
</style>
