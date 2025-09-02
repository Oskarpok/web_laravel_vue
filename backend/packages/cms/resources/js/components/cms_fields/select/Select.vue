<script setup>
import { ref, computed, watch } from "vue";
import Tooltip from '../components/Tooltip.vue'

const props = defineProps({
  label: String,
  name: String,
  wraper: String,
  value: [String, Number, Array, null],
  options: { type: Object, default: () => ({}) },
  readonly: { type: Boolean, default: false },
  required: { type: Boolean, default: false },
  searchable: { type: Boolean, default: false },
  multiple: { type: Boolean, default: false },
  tooltip: { type: String, default: "" },
});

const emit = defineEmits(["update:value"]);
const open = ref(false);
const searchTerm = ref("");
const selected = ref(props.value);

watch(
  () => props.value,
  (val) => {
    selected.value = val;
  }
);

const filteredOptions = computed(() => {
  if (!props.searchable || !searchTerm.value) return props.options;
  const term = searchTerm.value.toLowerCase();
  return Object.fromEntries(
    Object.entries(props.options).filter(([key, label]) =>
      label.toLowerCase().includes(term)
    )
  );
});

function selectOption(key) {
  if (!props.readonly) {
    selected.value = key;
    emit("update:value", key);
    open.value = false;
  }
}
</script>

<template>
  <div class="mb-3 relative" :class="wraper">
    <label :for="name" 
      class="flex text-sm font-medium text-gray-400 ml-2 mb-1 items-center gap-2">
      <span>{{ label }}</span>
      <Tooltip :tooltip="tooltip" />
    </label>

    <button
      type="button"
      @click="if (!readonly) { open = !open; searchTerm = '' }"
      class="mt-1 w-full border border-gray-600 rounded-xl px-3 py-2 
      text-gray-300 shadow-inner text-left"
      :class="readonly ? 'bg-[#1e293b] cursor-default' : '' ">
      {{ options[selected] ?? 'Wybierz opcję' }}
    </button>

    <div v-if="open"
      class="absolute z-10 mt-20 w-full cms-primary-color border border-gray-700 
        rounded-xl text-gray-100 shadow-lg max-h-64 overflow-auto p-2 bg-[#0f172a]">
      <input v-if="searchable"
        v-model="searchTerm"
        type="text"
        class="w-full mb-2 px-3 py-2 rounded-md bg-gray-800 border 
          border-gray-600 text-sm text-white focus:outline-none"/>

      <ul>
        <li v-for="(label, key) in filteredOptions" :key="key">
          <button
            type="button"
            :disabled="readonly"
            class="w-full text-left px-3 py-2 hover:bg-gray-600 rounded"
            @click="selectOption(key)">
            {{ label }}
          </button>
        </li>
        <li v-if="Object.keys(filteredOptions).length === 0" 
          class="text-gray-400 px-3 py-2 text-sm italic">
            Brak wyników
        </li>
      </ul>
    </div>
    <input type="hidden" :id="name" :name="name" :value="selected" />
  </div>
</template>