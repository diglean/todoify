import App from './App.vue'

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import router from './Router'
import Table from './components/TasksTable.vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap/dist/js/bootstrap.js'

import { BootstrapIconsPlugin } from "bootstrap-icons-vue";

const app = createApp(App)
const pinia = createPinia()

app.component('Table', Table)

app.use(router)
app.use(pinia)
app.use(BootstrapIconsPlugin);
app.mount('#app')
