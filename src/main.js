import Vue from "vue";
import App from "./App.vue";
import Vuelidate from "vuelidate";
window.Vue = Vue;
Vue.config.productionTip = false;
Vue.use(Vuelidate);
new Vue({
  render: (h) => h(App)
}).$mount("#app");
