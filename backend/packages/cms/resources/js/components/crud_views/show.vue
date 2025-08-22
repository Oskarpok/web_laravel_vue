<script setup>
import RenderField from '../cms_fields/RenderField.vue'

const props = defineProps({
  title: String,
  data: Object,
})
</script>

<template>
  <div class="bg-gray-950 p-6 text-gray-200 rounded-2xl">
    <div class="flex items-center justify-between mb-6 p-4 
      bg-[cms-background-color] rounded-lg shadow">
      <h1 class="text-xl font-semibold py-2">
        {{ title }}
      </h1>
      <div class="flex gap-x-2">
        <RenderField v-for="(field, idx) in data.buttons"
          :key="idx"
          :field="field"
        />
      </div>
    </div>
    <div class="w-full mx-auto text-gray-200 border border-gray-600 p-6 
      shadow rounded-2xl space-y-6 flex flex-wrap gap-5 place-items-center">
      <RenderField v-for="(field, idx) in data.fields"
        :key="idx"
        :field="field"
      />
    </div>
  </div>
</template>