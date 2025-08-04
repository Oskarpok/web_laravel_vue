<script setup>
import Footer from "./components/layouts_elements/footer.vue";
import Header from "./components/layouts_elements/header.vue";
import Nav from "./components/layouts_elements/nav.vue";

import { defineAsyncComponent, ref, watchEffect } from 'vue'

const { component, props } = defineProps(['component', 'props'])
const pageComponent = ref(null)
const components = import.meta.glob([
  './components/**/*.vue',
  './pages/**/*.vue',
  './views/**/*.vue'
])

/**
 * Auto components render
 */
watchEffect(() => {
  const path = `./${component}.vue`
  if (components[path]) {
    pageComponent.value = defineAsyncComponent(components[path])
  } else {
    pageComponent.value = null
  }
})
</script>

<template>
  <div class="flex">
    <Nav />
    <div class="flex flex-col flex-1">
      <Header />
      <main class="flex-1 mx-4">
        <component :is="pageComponent" v-bind="props" />
      </main>
    </div>
  </div>
  <Footer />
</template>