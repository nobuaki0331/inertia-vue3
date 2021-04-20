<template>
  <div>
    <h1>Vue3.0 Composition API</h1>
    <button
      class="bg-blue-400"
      @click="increment">
      Click
    </button>
    <p>Count: {{ count }}</p>
    <p>doubleCount: {{ doubleCount }}</p>
  </div>
</template>

<script>
import { ref, onMounted, computed, reactive, toRefs } from "vue";
import { hoge } from '../actions/hoge'

export default {
  name: 'Task',
  setup() {
    const { increment, count, doubleCount } = hoge()
    onMounted(() => console.log('mounted!'))

    return {
      increment,
      count,
      doubleCount
    }
  }
}
</script>
