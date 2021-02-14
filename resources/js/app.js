import Vue from 'vue'
import axios from "axios";

//Main pages
import App from './views/app.vue'

axios.defaults.baseURL = 'http://takenlijst.test/'

const app = new Vue({
    el: '#app',
    components: { App },
});
