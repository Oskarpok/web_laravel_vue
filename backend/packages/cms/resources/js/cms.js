import { createApp } from 'vue'
import App from './App.vue'

const el = document.getElementById('app')
const component = el.dataset.view
const props = JSON.parse(el.dataset.props)

createApp(App, {
  component: component,
  props: props
}).mount('#app')
