require('./bootstrap');

window.Vue = require('vue');

import User from './Helpers/User';
window.User = User;

console.log(User.loggedIn())

window.EventBus = new Vue();

// Vue Progress bar
import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
  color: 'rgb(143, 255, 199)',
  failedColor: 'red',
  height: '2px'
})

// SimpleMDE 
import VueSimplemde from 'vue-simplemde'
import md from 'marked'

Vue.component('vue-simplemde', VueSimplemde)
window.md = md

// Sweet Alert
import Swal from 'sweetalert2'
window.Swal = Swal

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

window.Toast = Toast


Vue.component('NavigationBar', require('./components/NavigationBar.vue').default);
Vue.component('ShowQuestion', require('./components/Forum/ShowQuestion.vue').default);

import router from './Router/router_.js'

const app = new Vue({
  el: '#app',
  router
});