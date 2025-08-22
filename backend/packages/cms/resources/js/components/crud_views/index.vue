<script setup>
import Table from '../cms_fields/extra/Table.vue'
import RenderField from '../cms_fields/RenderField.vue'

const props = defineProps({
  table: Object,
  buttons: Object,
  title: String
})
</script>

<template>
  <div class="bg-gray-950 p-6 text-gray-200 rounded-2xl">
    <div class="flex items-center justify-between mb-6 p-4 
      bg-[cms-background-color] rounded-lg shadow">
        <h1 class="text-xl font-semibold py-2">{{ title }}</h1>
        <div class="flex gap-x-2">
          <RenderField v-for="(field, idx) in buttons"
            :key="idx"
            :field="field"
          />
        </div>
    </div>
    <div class="overflow-x-auto">
      <Table
        :labels="table.labels"
        :data="table.data"
        :filterable="table.filterable"
        :filtersInitial="table.filtersInitial"
      />
    </div>
  </div>
</template>