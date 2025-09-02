<script setup>
import { ref, watch } from "vue";
import Tooltip from '../components/Tooltip.vue'

const props = defineProps({
  label: String,
  name: String,
  wraper: String,
  value: {
    type: [Number, String],
    default: 0
  },
  step: {
    type: Number,
    default: 1
  },
  readonly: Boolean,
  required: Boolean,
  max: Number,
  min: Number,
  allowFloat: {
    type: Boolean,
    default: true
  },
  tooltip: String,
  errors: {
    type: Array,
    default: () => []
  }
});

const emit = defineEmits(["update:value"]);

const internalValue = ref(props.value);
const internalErrors = ref([...props.errors]);

watch(
  () => props.value,
  (val) => {
    internalValue.value = val;
  }
);

watch(internalValue, (val) => {
  validate(val);
  emit("update:value", val);
});

function validate(val) {
  internalErrors.value = [];

  if (props.required && (val === "" || val === null || val === undefined)) {
    internalErrors.value.push("To pole jest wymagane");
  }

  if (props.min !== undefined && val < props.min) {
    internalErrors.value.push(`Wartość nie może być mniejsza niż ${props.min}`);
  }

  if (props.max !== undefined && val > props.max) {
    internalErrors.value.push(`Wartość nie może być większa niż ${props.max}`);
  }
}

function onKeyDown(e) {
  const key = e.key;
  const value = e.target.value;
  const caret = e.target.selectionStart ?? 0;
  const isNumber = /^[0-9]$/.test(key);
  const allowed = ["Backspace", "Tab", "ArrowLeft", "ArrowRight", "Delete"];

  if (!allowed.includes(key) && !isNumber && key !== "." && key !== "-") {
    e.preventDefault();
  }

  if (key === ".") {
    if (value.includes(".") || caret === 0 || !props.allowFloat) {
      e.preventDefault();
    }
  }

  if (key === "-") {
    if (value.includes("-") || caret !== 0) {
      e.preventDefault();
    }
  }
}
</script>

<template>
  <div class="mb-3 relative" :class="wraper">
    <label :for="name" class="flex text-sm font-medium text-gray-400 ml-2 
      mb-1 items-center gap-2">
      {{ label }}
      <Tooltip :tooltip="tooltip" />
    </label>

    <ul v-if="internalErrors.length" class="text-red-500 text-xs mb-1 ml-2 
      space-y-0.5">
      <li v-for="err in internalErrors" :key="err">{{ err }}</li>
    </ul>

    <div class="flex items-center border border-gray-600 rounded-xl 
      shadow-inner mt-1"
      :class="[
        readonly ? 'bg-[#1e293b]' : '',
        internalErrors.length ? 'border-red-500' : 'border-gray-600',
      ]">
      <input type="text"
        v-model="internalValue"
        class="w-full bg-transparent text-gray-300 px-3 py-2 rounded-l-xl 
          focus:outline-none"
        :class="readonly ? 'cursor-default' : ''"
        :id="name"
        :name="name"
        :readonly="readonly"
        :required="required"
        :max="max"
        :min="min"
        inputmode="decimal"
        @keydown="onKeyDown"/>

      <div class="flex flex-col">
        <button type="button"
          @click="internalValue = Number(internalValue) + step"
          class="text-[#898d95] px-1 py-0.5 text-xs rounded-tr-xl"
          :class="readonly ? 'cursor-default' : 'hover:text-[#d1d5dc]'"
          aria-label="Increment"
          :disabled="readonly">
          ▲
        </button>
        <button type="button"
          @click="internalValue = Number(internalValue) - step"
          class="text-[#898d95] px-1 py-0.4 text-xs rounded-br-xl"
          :class="readonly ? 'cursor-default' : 'hover:text-[#d1d5dc]'"
          aria-label="Decrement"
          :disabled="readonly">
          ▼
        </button>
      </div>
    </div>
  </div>
</template>

<style scoped>
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

input[type="number"] {
  -moz-appearance: textfield;
}
</style>