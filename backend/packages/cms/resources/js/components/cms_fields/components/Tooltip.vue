<template>
  <div v-if="tooltip" class="relative inline-block">
    <i class="fa-solid fa-circle-question text-gray-400 cursor-pointer 
      text-xs peer">
    </i>
    <div class="absolute top-1/2 left-full ml-2 -translate-y-1/2 z-10 w-max px-2 
      py-1 bg-gray-800 text-gray-200 text-xs rounded shadow-lg opacity-0 
      peer-hover:opacity-100 transition-opacity text-left pointer-events-none">
      <div v-for="line in tooltip.split('|')" :key="line">
        {{ line.trim() }}
      </div>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  tooltip: { type: String }
})
</script>
