<script setup>
import { ref, watch } from 'vue'
import Tooltip from '../components/Tooltip.vue'

const props = defineProps({
  label: { type: String, required: true },
  name: { type: String, required: true },
  wraper: { type: String, default: '' },
  value: { type: String, default: '' },
  readonly: { type: Boolean, default: false },
  required: { type: Boolean, default: false },
  tooltip: { type: String, default: '' },
  errors: { type: Array, default: () => [] },
})

const inputValue = ref(props.value)
const validationErrors = ref([...props.errors])

watch(inputValue, (val) => {
  validationErrors.value = []

  if (props.required && (!val || val.trim() === '')) {
    validationErrors.value.push('To pole jest wymagane')
  }
  // opcjonalna walidacja numeru telefonu
  if (val && !/^[0-9+\-\s()]+$/.test(val)) {
    validationErrors.value.push('Nieprawidłowy numer telefonu')
  }
})
</script>

<template>
  <div class="mb-3 relative" :class="wraper">
    <label :for="name" class="flex text-sm font-medium text-gray-400 ml-2 
      mb-1 items-center gap-2">
      {{ label }}
      <Tooltip :tooltip="tooltip" />
    </label>

    <ul v-if="validationErrors.length" class="text-red-500 text-xs mb-1 ml-2 
      space-y-0.5">
      <li v-for="(err, idx) in validationErrors" :key="idx">{{ err }}</li>
    </ul>

    <input type="tel"
      v-model="inputValue"
      :id="name"
      :name="name"
      :readonly="readonly"
      :required="required"
      class="mt-1 w-full border rounded-xl px-3 py-2 text-gray-300 
        shadow-inner focus:outline-none"
      :class="[
        readonly ? 'bg-[#1e293b]' : '',
        validationErrors.length ? 'border-red-500' : 'border-gray-600'
      ]"/>
  </div>
</template>