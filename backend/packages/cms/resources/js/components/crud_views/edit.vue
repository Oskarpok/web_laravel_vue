<script setup>
import RenderField from '../cms_fields/RenderField.vue'

const props = defineProps({
  title: String,
  fields: Array,
})

</script>

<template>
  <div class="bg-gray-950 p-6 text-gray-200 rounded-2xl">
    <form method="POST" 
      action="">
      <div class="flex items-center justify-between mb-6 p-4 
        bg-[cms-background-color] rounded-lg shadow">
        <h1 class="text-xl font-semibold py-2">
          {{ title }}
        </h1>
        <div class="flex gap-x-2">

        </div>

      </div>
      <div class="w-full mx-auto p-6 shadow rounded-2xl space-y-6 text-gray-200 
        border border-gray-600 flex flex-wrap gap-5 place-items-center">
        <RenderField
          v-for="(field, idx) in fields"
          :key="idx"
          :field="field"
        />
      </div>
    </form>
  </div>
</template>