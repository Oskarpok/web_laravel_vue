<script setup>
import { reactive } from 'vue'

const props = defineProps({
  labels: Array,
  data: Array,
  filterable: Object,
  filtersInitial: Object
})

const emit = defineEmits(['filter'])
const filters = reactive({ ...props.filtersInitial })
const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''

function route(name = null, id = null) {
  const base = 'cms/' + window.location.pathname.split('/')[2] || ''

  switch (name) {
    case 'destroy':
    case 'edit':
    case 'show':
      return `/${base}/${id}${name === 'edit' ? '/edit' : ''}`

    default:
      return `/${base}`
  }
}

function confirmDelete(event, id) {
  if (confirm('Na pewno chcesz usunąć?')) {
    const form = event.target.closest('form')
    form.submit()
  }
}
</script>

<template>
  <form>
    <table class="w-full table-auto border border-gray-700 text-left overflow-hidden">
      <thead class="text-gray-300">
        <tr class="bg-gray-900 text-sm font-semibold uppercase tracking-wider">
          <th v-for="(label, index) in labels" :key="index" 
            class="px-4 py-3 border border-gray-700">
            <span v-html="label" />
          </th>
          <th class="px-4 py-3 border border-gray-700">
            <span>Actions</span>
          </th>
        </tr>

        <tr>
          <th v-for="(enabled, key) in filterable" :key="key" 
            class="px-2 py-2 border border-gray-700">
            <input
              v-model="filters[key]"
              :disabled="!enabled"
              type="text"
              class="w-full px-3 py-2 text-sm rounded-md text-white 
                bg-gray-900 placeholder-gray-400 border border-gray-600 
                focus:outline-none focus:ring-2 focus:ring-blue-500"/>
          </th>

          <th class="px-2 py-2 border border-gray-700 text-center">
            <button type="submit"
              class="bg-blue-600 hover:bg-blue-500 text-white text-sm 
                px-4 py-2 rounded-md focus:outline-none focus:ring-2 
                focus:ring-blue-400 focus:ring-offset-1">
              Filtruj
            </button>
          </th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="row in data" :key="row.id" class="hover:bg-gray-800">
          <td v-for="(enabled, key) in filterable" :key="key" 
            class="px-3 py-2 border border-gray-700">
            {{ row[key + '_label'] ?? row[key] }}
          </td>
          
          <td class="w-27 px-4 py-2 border border-gray-700 text-center space-x-2">
            <a :href="route('show', row.id)" title="Zobacz" 
              class="text-sky-400 hover:text-sky-300">
              <i class="fa-solid fa-eye"></i>
            </a>
            <a :href="route('edit', row.id)" title="Edytuj" 
              class="text-yellow-400 hover:text-yellow-300">
              <i class="fas fa-edit"></i>
            </a>
            <form :action="route('destroy', row.id)"
              method="POST"
              @submit.prevent="event => confirmDelete(event, row.id)"
              class="inline" >
              <input type="hidden" name="_method" value="DELETE" />
              <input type="hidden" name="_token" :value="csrfToken" />
              <button type="submit"
                class="text-rose-500 hover:text-rose-400"
                title="Usuń">
                <i class="fas fa-trash-alt"></i>
              </button>
            </form>
          </td>
        </tr>
      </tbody>
    </table>
  </form>
</template>
