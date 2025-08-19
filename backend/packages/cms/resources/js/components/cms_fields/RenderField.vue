<script setup>
import { defineAsyncComponent, watch, markRaw, shallowRef } from 'vue'

const props = defineProps({
  field: {
    type: Object,
    required: false // teraz nie jest wymagane
  }
})

const components = import.meta.glob('./**/*.vue')
const component = shallowRef(null)

watch(
  () => props.field?.view, // <-- używamy opcjonalnego chainingu
  (viewPathRaw) => {
    if (!viewPathRaw) {
      component.value = null
      return
    }

    const viewPath = viewPathRaw.replace(/\.vue$/, '')

    const match = Object.keys(components).find(key =>
      key.replace(/^\.\//, '').replace(/\.vue$/, '') === viewPath
    )

    if (match) {
      component.value = markRaw(defineAsyncComponent(components[match]))
    } else {
      component.value = null
    }

  },
  { immediate: true }
)
</script>

<template>
  <component
    v-if="component"
    :is="component"
    v-bind="field"
  />
</template>