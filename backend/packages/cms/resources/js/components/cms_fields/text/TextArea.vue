<script setup>
import { ref, watch } from 'vue'
import Tooltip from '../components/Tooltip.vue'

const props = defineProps({
  label: { type: String, required: true },
  name: { type: String, required: true },
  wraper: { type: String, default: '' },
  value: { type: String, default: '{}' },
  readonly: { type: Boolean, default: false },
  tooltip: { type: String, default: '' },
})

const emit = defineEmits(['update:value'])
const internalValue = ref(JSON.stringify(JSON.parse(props.value || '{}'), null, 2))

watch(internalValue, (val) => {
  emit('update:value', val)
})
</script>

<template>
  <div class="mb-3 relative" :class="wraper">
    <label :for="name" 
      class="flex text-sm font-medium text-gray-400 ml-2 mb-1 items-center gap-2">
      {{ label }}
      <Tooltip :tooltip="tooltip" />
    </label>
    <textarea :id="name"
      :name="name"
      :readonly="readonly"
      v-model="internalValue"
      class="mt-1 w-full border border-gray-600 rounded-xl px-3 py-2 
        text-gray-300 shadow-inner focus:outline-none"
      :class="readonly ? 'bg-[#1e293b] cursor-default' : ''"
      rows="5"></textarea>
  </div>
</template>