<template>
  <div class="inline-block w-64 px-3">
    <label
      :for="name"
      class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
      {{ label }}
    </label>
    <select
      v-model="value"
      :id="name"
      :disabled="disabled"
      :class="{ 'bg-gray-50' : disabled }"
      class="block appearance-none w-full border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
      <option
        v-for="(option, i) in options"
        :key="i"
        :selected="option === modelValue">
        {{ option }}
      </option>
    </select>
  </div>
</template>

<script>
export default { name: 'SelectInput' }
</script>

<script setup>
import { defineProps, computed, defineEmits } from "vue"

const props = defineProps({
  label: {
    type: String,
    required: true,
  },
  name: {
    type: String,
    required: true,
  },
  modelValue: {
    type: String,
    required: true,
  },
  options: {
    type: Array,
    default: () => [],
  },
  disabled: {
    type: Boolean,
    default: false,
  }
})
const emit = defineEmits(['update:modelValue'])
const value = computed({
  get: () => props.modelValue,
  set: (val) => emit('update:modelValue', val)
})

</script>
