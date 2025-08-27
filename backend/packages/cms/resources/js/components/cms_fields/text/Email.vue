<script setup>
import { ref, watch, computed } from "vue"

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

// lokalny stan value (jak x-model w Alpine)
const inputValue = ref(props.value)

// błędy walidacji
const localErrors = ref([...props.errors])

// walidacja jak w Alpine
watch(inputValue, (val) => {
  localErrors.value = []

  if (props.required && (!val || val === "")) {
    localErrors.value.push("To pole jest wymagane")
  }
})

// tooltip jako tablica linii
const tooltipLines = computed(() =>
  props.tooltip ? props.tooltip.split("|").map(l => l.trim()) : []
)
</script>

<template>
  <div
    class="mb-3 relative"
    :class="wraper"
  >
    <!-- label -->
    <label :for="name" class="flex text-sm font-medium text-gray-400 ml-2 mb-1 items-center gap-2">
      <span>{{ label }}</span>
      <div v-if="tooltip" class="relative group">
        <i class="fa-solid fa-circle-question text-gray-400 cursor-pointer text-xs"></i>
        <div
          class="absolute top-1/2 left-full ml-2 -translate-y-1/2 z-10 w-max 
                 px-2 py-1 bg-gray-800 text-gray-200 text-xs rounded 
                 shadow-lg opacity-0 group-hover:opacity-100 transition-opacity text-left"
        >
          <div v-for="line in tooltipLines" :key="line">{{ line }}</div>
        </div>
      </div>
    </label>

    <!-- errors -->
    <ul v-if="localErrors.length" class="text-red-500 text-xs mb-1 ml-2 space-y-0.5">
      <li v-for="err in localErrors" :key="err">{{ err }}</li>
    </ul>

    <!-- input -->
    <input
      type="email"
      v-model="inputValue"
      :id="name"
      :name="name"
      :readonly="readonly"
      :required="required"
      class="mt-1 w-full border rounded-xl px-3 py-2 text-gray-300 shadow-inner focus:outline-none"
      :class="[
        readonly ? 'bg-[#1e293b]' : '',
        localErrors.length ? 'border-red-500' : 'border-gray-600'
      ]"
    >
  </div>
</template>
