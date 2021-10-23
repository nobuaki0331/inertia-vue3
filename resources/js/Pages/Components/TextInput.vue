<template>
  <div class="w-1/2 px-3">
    <label
      :for="name"
      class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
      {{ label }}
    </label>
      <input
        v-model="value"
        :id="name"
        :disabled="disabled"
        :class="{ 'border-red-500' : isActiveClass }"
        class="appearance-none block w-full  text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
  </div>
</template>

<script>
export default { name: 'TextInput' }
</script>

<script setup>
import { ref, watch, computed, defineProps, defineEmits } from "vue"

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
    type: [ String, Number ],
    default: '',
  },
  disabled: {
    type: Boolean,
    default: false,
  },
})
const emit = defineEmits(['update:modelValue'])
const value = computed({
  get: () => props.modelValue,
  set: (val) => emit('update:modelValue', val)
})
const isActiveClass = ref(false)
watch(
  () => props.modelValue,
  () => {
    isActiveClass.value = true
  }
)
</script>
