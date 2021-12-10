import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    error: null,
    userToken: localStorage.getItem('token') || null,
    product_list: null,
    product_links: null,
    current_page: null,
    product_update_id: null,
    last_page: null
  },
  mutations: {
    set_error_message: function (state, msg) {
      state.error = msg
    },
    set_user_token: function (state, token) {
      state.userToken = token
    },
    set_product_list_and_links: function (state, data) {
      state.product_list = data.data
      state.product_links = data.links
    },
    set_search_result_for_products: function (state, data) {
      state.product_list = data
    },
    set_current_page: function (state, page_number) {
      state.current_page = page_number
    },
    set_product_update_id: function (state, id) {
      state.product_update_id = id
    },
    set_last_page: function (state, page) {
      state.last_page = page
    }
  },
  actions: {
    login: function (context, user) {
      return new Promise((resolve, reject) => {
        axios.post(process.env.VUE_APP_SERVER_HOST + 'login', { email: user.email, password: user.password }).then(response => {
          localStorage.setItem("token", response.data.access_token)
          context.commit('set_user_token', response.data.access_token)
          resolve(response)
        }).catch(error => {
          console.log(error.response.data.message)
          context.commit('set_error_message', error.response.data.message)
          reject(error)
        })
      })
    },
    get_products (context, page_number) {
      return new  Promise((resolve, reject) => {
        axios.get(process.env.VUE_APP_SERVER_HOST + `products?page=${ parseInt(page_number) }`, { headers: { "Authorization": `Bearer ${this.state.userToken}`} }).then((response) =>{
          if(page_number > response.data.last_page || page_number < 1){
            reject("Page does not exist")
          }
          else {
            context.commit('set_product_list_and_links', { 'data': response.data.data, 'links': response.data.links })
            context.commit('set_current_page', parseInt(page_number))
            context.commit('set_last_page', response.data.last_page)
          }
          resolve(response)
        })
      })
    },
    logout: function (context) {
      return new Promise((resolve) => {
        axios.post(process.env.VUE_APP_SERVER_HOST + 'logout', {}, { headers: { "Authorization": `Bearer ${this.state.userToken}`} }).then((response) => {
          console.log(response.data.message)
          context.commit('set_error_message', response.data.message)
          localStorage.removeItem('token')
          resolve(response)
        })
      })
    },
    search: function (context, title) {
      return new Promise((resolve, rejecet) => {
        axios.get(process.env.VUE_APP_SERVER_HOST + `products/search/${title}`, { headers: { "Authorization": `Bearer ${this.state.userToken}`} }).then((response) => {
          console.log(response.data.data)
          if(response.data.data.length > 0){
            context.commit('set_search_result_for_products', response.data.data)
          }
          else {
            context.dispatch('get_products', this.state.current_page)
          }
          resolve(response)
        }).catch((error) => {
          console.log(error.response)
          rejecet(error)
        })
      })
    },
    delete: function (context, id) {
      return new Promise((resolve) => {
        axios.delete(process.env.VUE_APP_SERVER_HOST + `products/${id}`, { headers: { "Authorization": `Bearer ${this.state.userToken}`} }).then((response) =>{
          context.dispatch('get_products', this.state.current_page)
          resolve(response)
        })
      })
    },
    add_product: function (context, product) {
      return new Promise((resolve) => {
        if(this.state.product_update_id == null){
          axios.post(process.env.VUE_APP_SERVER_HOST + 'products', {title: product.title}, { headers: { "Authorization": `Bearer ${this.state.userToken}`} }).then(() =>{
            context.dispatch('get_products', this.state.last_page)
          })
        } else {
          axios.put(process.env.VUE_APP_SERVER_HOST + `products/${product.id}`, {title: product.title},{ headers: { "Authorization": `Bearer ${this.state.userToken}`} } ).then(() => {
            context.dispatch('get_products', this.state.current_page)
          })
        }
        resolve("Added/Updated product successfully!")
      })
    }
  },
  modules: {
  }
})
