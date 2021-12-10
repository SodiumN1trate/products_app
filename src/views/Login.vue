<template>
  <div class="about">
    <Header title="Pieteikšanās" />
    <form  @submit.prevent="login">
      <h3 class="error-message">{{ this.$store.state.error }}</h3>
      <input type="email" v-model="email" placeholder="E-pasts" required>
      <input type="password" v-model="password" placeholder="Parole" required>
      <button>Pieslēgties</button>
    </form>
  </div>
</template>

<script>
import Header from '../components/Header'
export default {
  name: 'Login',
  components: {Header},
  data: function () {
    return {
      email: null,
      password: null
    }
  },
  methods: {
    login: function () {
      this.$store.dispatch('login', { email: this.email, password: this.password }).then(() => {
        if(this.$store.state.userToken != null) {
          this.$router.push('/')
        }
      })
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
