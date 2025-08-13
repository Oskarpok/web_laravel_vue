<script setup>
import { ref, watch } from 'vue'

const props = defineProps({
  label: String,
  name: String,
  wraper: String,
  value: [String, Number, null],
  readonly: Boolean,
  required: Boolean,
  tooltip: String,
  errors: {
    type: Array,
    default: () => []
  }
})

// Lokalne dane (kopiujemy wartość, żeby obsłużyć v-model wewnętrznie)
const localValue = ref(props.value ?? '')
const localErrors = ref([...props.errors])

// Walidacja wymagalności pola
watch(localValue, (val) => {
  localErrors.value = [...props.errors] // zachowujemy błędy z backendu
  if (props.required && (val === '' || val === null || val === undefined)) {
    localErrors.value.push('To pole jest wymagane')
  }
})
</script>

<template>
  <div class="mb-3 relative" :class="wraper">
    <!-- Etykieta z tooltipem -->
    <label :for="name" class="flex text-sm font-medium text-gray-400 ml-2 mb-1 items-center gap-2">
      <span>{{ label }}</span>
      <template v-if="tooltip">
        <div class="relative group">
          <i class="fa-solid fa-circle-question text-gray-400 cursor-pointer text-xs"></i>
          <div class="absolute top-1/2 left-full ml-2 -translate-y-1/2 z-10 w-max 
            px-2 py-1 bg-gray-800 text-gray-200 text-xs rounded shadow-lg 
            opacity-0 group-hover:opacity-100 transition-opacity text-left">
            <div v-for="(line, i) in tooltip.split('|')" :key="i">
              {{ line.trim() }}
            </div>
          </div>
        </div>
      </template>
    </label>

    <!-- Lista błędów -->
    <ul v-if="localErrors.length" class="text-red-500 text-xs mb-1 ml-2 space-y-0.5">
      <li v-for="(err, idx) in localErrors" :key="idx">{{ err }}</li>
    </ul>

    <!-- Pole tekstowe -->
    <input
      type="text"
      v-model="localValue"
      :id="name"
      :name="name"
      :readonly="readonly"
      :required="required"
      class="mt-1 w-full border rounded-xl px-3 py-2 text-gray-300 shadow-inner focus:outline-none"
      :class="[
        readonly ? 'bg-[#1e293b] cursor-default' : '',
        localErrors.length ? 'border-red-500' : 'border-gray-600'
      ]"
    >
  </div>
</template>