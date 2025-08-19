<script setup>
import { ref, watch } from 'vue'

const props = defineProps({
  label: { type: String, required: true },
  name: { type: String, required: true },
  wraper: { type: String, default: '' },
  value: { type: String, default: '' },
  readonly: { type: Boolean, default: false },
  required: { type: Boolean, default: false },
})

const internalValue = ref(props.value)

const emit = defineEmits(['update:value'])

watch(internalValue, (val) => {
  emit('update:value', val)
})
</script>

<template>
  <div class="mb-3 relative" :class="wraper">
    <label
      :for="name"
      class="block text-sm font-medium text-gray-400 ml-2 mb-1">
      {{ label }}
    </label>
    <input
      type="datetime-local"
      :id="name"
      :name="name"
      :readonly="readonly"
      :required="required"
      v-model="internalValue"
      class="mt-1 w-full border border-gray-600 rounded-xl px-3 py-2
        text-gray-300 shadow-inner cursor-default focus:outline-none"
      :class="readonly ? 'bg-[#1e293b]' : '' "
    />
  </div>
</template>