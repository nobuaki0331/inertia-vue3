<template>
  <button
    :class="bgColor"
    class="px-4 py-2 rounded-md text-xs text-white border-blue-700 hover:border-blue-500">
    <slot />
  </button>
</template>

<script>
export default { name: 'Button' }
</script>

<script setup>
import { defineProps } from "vue"

const props = defineProps({
  bgColor: {
    type: String,
    required: true,
  },
})
</script>
