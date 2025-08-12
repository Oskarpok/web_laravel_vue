<script setup>
import Table from '../cms_fields/extra/Table.vue'

const props = defineProps({
  table: Object,
  title: String
})
</script>

<template>
  <div class="bg-gray-950 p-6 text-gray-200 rounded-2xl">
    <h1 class="text-xl font-semibold mb-4">{{ title }}</h1>

    <Table
      :labels="table.labels"
      :data="table.data"
      :filterable="table.filterable"
      :filtersInitial="table.filtersInitial"
    />
  </div>
</template>