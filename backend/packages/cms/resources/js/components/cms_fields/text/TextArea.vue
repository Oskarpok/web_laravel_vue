<script setup>
import { ref, watch, computed } from 'vue'

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
const tooltipLines = computed(() => props.tooltip.split('|').map(line => line.trim()))

watch(internalValue, (val) => {
  emit('update:value', val)
})
</script>

<template>
  <div class="mb-3 relative" :class="wraper">
    <label :for="name" 
      class="flex text-sm font-medium text-gray-400 ml-2 mb-1 items-center gap-2">
      <span>{{ label }}</span>
      <div v-if="tooltip" class="relative group">
        <i class="fa-solid fa-circle-question text-gray-400 cursor-pointer text-xs">
        </i>
        <div class="absolute top-1/2 left-full ml-2 -translate-y-1/2 z-10 w-max 
          px-2 py-1 bg-gray-800 text-gray-200 text-xs rounded shadow-lg 
          opacity-0 group-hover:opacity-100 transition-opacity text-left">
          <div v-for="(line, index) in tooltipLines" :key="index">
            {{ line }}
          </div>
        </div>
      </div>
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