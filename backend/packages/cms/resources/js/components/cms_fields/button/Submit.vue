<script setup>
const props = defineProps({
  label: { type: String, required: true },
  name: { type: String, required: true },
  wraper: { type: String, default: '' },
  icone: { type: String, default: '' },
  type: { type: String},
})
</script>

<template>
  <button
    :id="name"
    :name="name"
    :type="type"
    class="flex text-white bg-emerald-600 hover:bg-emerald-500 
      items-center gap-2 px-4 py-2 rounded transition"
    :class="[wraper]">
    <i v-if="icone" :class="icone"></i>
    <span>{{ label }}</span>
  </button>
</template>
