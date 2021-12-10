<template>
  <div class="home">

    <Header title="Produktu saraksts" />

    <div id="searchbar-with-buttons-block">
      <form @submit.prevent="search" id="search-bar">
        <img @click.prevent="search" src="https://cdn.discordapp.com/attachments/745593995270553653/918527485275172864/585e4ae1cb11b227491c3393.png" width="15px" height="15px" >
        <input type="text" v-model="searchInput">
      </form>
      <div class="buttons-block">
        <button @click="$router.push('/AddProduct')">Pievienot</button>
        <button @click="logout">Izrakstīties</button>
      </div>
    </div>

    <div id="product-library">

      <div class="product-card" v-for="(product, id) of this.$store.state.product_list" :key="id">
        <span>{{ product.title }} #<span>{{ product.id }}</span></span>
        <div class="buttons-block">
          <button @click="edit_product(product.id)">Labot</button>
          <button @click="$store.dispatch('delete', product.id)">Dzēst</button>
        </div>
      </div>
    </div>

    <div id="paginate-navigation">
      <template v-for="(link, id) of this.$store.state.product_links">
        <span :key="id" v-if="link.label == '&laquo; Previous'" @click="$store.dispatch('get_products', $store.state.current_page - 1)">Atpakaļ</span>
        <span :key="id" v-else-if="link.label == 'Next &raquo;'"  @click="$store.dispatch('get_products', $store.state.current_page + 1)">Uz priekšu</span>
        <template v-else>
          <span :key="id" v-if="link.label != '1'">|</span>
          <span :key="id" v-if="link.active" style="color: gray">{{ link.label }}</span>
          <span :key="id" @click="$store.dispatch('get_products', link.label)" v-else>{{ link.label }}</span>
        </template>
      </template>
    </div>
  </div>
</template>

<script>
import Header from '../components/Header'
export default {
  name: 'Home',
  components: {
    Header
  },
  data: function () {
    return {
      searchInput: ''
    }
  },
  mounted: function () {
    if(this.$store.state.userToken == null) {
      this.$router.push('/login')
    }
    this.$store.dispatch('get_products', 1)
  },
  methods: {
    logout: function () {
      this.$store.dispatch('logout').then(() => {
        this.$router.push('/login')
      })
    },
    search: function () {
      if(this.searchInput != ''){
        this.$store.dispatch('search', this.searchInput)
      }
    },
    edit_product: function (id) {
      this.$store.commit('set_product_update_id', id)
      this.$router.push('/AddProduct')
    }
  }
}
</script>

<style>
#searchbar-with-buttons-block {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  align-items: center;
  width: 63%;
  height: 50px;
  margin-top: 2%;
  margin-left: auto;
  margin-right: 4%;
}

.buttons-block {
  display: flex;
  gap: 20px;
}

.buttons-block > button {
  background-color: transparent;
  border: 1px solid black;
  padding: 6px 30px;
}


.buttons-block > button:hover {
  cursor: pointer;
}

#search-bar {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 50%;
  border: 1px solid black;
  border-radius: 15px;
  height: 25px;
  padding: 2px;
  gap: 1%;
}

#search-bar > input {
  width: 90%;
  border: none;
  background: transparent;
  outline: none;
}

#search-bar > img:hover {
  cursor: pointer;
}

#product-library {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  gap: 20px;
  margin-top: 4%;
  margin-left: 5%;
  margin-right: 5%;
}


.product-card {
  display: flex;
  flex-direction: column;
  justify-content: space-around;
  border: 1px solid black;
  width: 20%;
  padding-left: 10px;
  padding-bottom: 5px;
  padding-top: 20px;
  font-weight: lighter;
}

.product-card > .buttons-block {
  margin-top: 20%;
}

.product-card > .buttons-block > button {
  padding: 10px;
  gap: 5px;
}

#paginate-navigation {
  margin-top: 10%;
  display: flex;
  justify-content: center;
  gap: 20px;
  font-size: 13px;
}

#paginate-navigation > span:hover {
  cursor: pointer;
}

</style>
