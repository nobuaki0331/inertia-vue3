<template>
  <button class="bg-blue-500 hover:bg-blue-400 px-4 py-2 rounded-md text-xs text-white border-blue-700 hover:border-blue-500">
    <slot />
  </button>
</template>

<script>
export default {
  name: 'Button',
}
</script>
