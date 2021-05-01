<template>
  <div class="w-1/2 px-3">
    <label
      :for="name"
      class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
      {{ label }}
    </label>
      <input
        :value="modelValue"
        :id="name"
        :class="{ 'border-red-500' : isActiveClass }"
        class="appearance-none block w-full  text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
        @input="$emit('update:modelValue', $event.target.value)">
  </div>
</template>

<script>
import { ref, watch, watchEffect } from "vue";

export default {
  name: 'TextIput',
  props: {
    label: {
      type: String,
      required: true,
    },
    name: {
      type: String,
      required: true
    },
    modelValue: {
      type: [ String, Number ],
      default: ''
    },
  },
  setup(props) {
    const isActiveClass = ref(false)
    watch(
      () => props.modelValue,
      () => {
        isActiveClass.value = true
      }
    )

    return {
      isActiveClass,
    }
  },
}
</script>
