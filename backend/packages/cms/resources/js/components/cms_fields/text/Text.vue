<script setup>
import { ref, watch } from 'vue'
import Tooltip from '../components/Tooltip.vue'

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

const localValue = ref(props.value ?? '')
const localErrors = ref([...props.errors])

watch(localValue, (val) => {
  localErrors.value = [...props.errors]
  if (props.required && (val === '' || val === null || val === undefined)) {
    localErrors.value.push('To pole jest wymagane')
  }
})
</script>

<template>
  <div class="mb-3 relative" :class="wraper">
    <label :for="name" class="flex text-sm font-medium text-gray-400 ml-2 mb-1 items-center gap-2">
      {{ label }}
      <Tooltip :tooltip="tooltip" />
    </label>

    <ul v-if="localErrors.length" class="text-red-500 text-xs mb-1 ml-2 space-y-0.5">
      <li v-for="(err, idx) in localErrors" :key="idx">{{ err }}</li>
    </ul>

    <input type="text"
      v-model="localValue"
      :id="name"
      :name="name"
      :readonly="readonly"
      :required="required"
      class="mt-1 w-full border rounded-xl px-3 py-2 text-gray-300 
        shadow-inner focus:outline-none"
      :class="[
        readonly ? 'bg-[#1e293b] cursor-default' : '',
        localErrors.length ? 'border-red-500' : 'border-gray-600'
      ]"
    >
  </div>
</template>