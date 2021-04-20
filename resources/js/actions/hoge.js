import { ref, computed } from 'vue'

export const hoge = () => {
    // RefImpl というオブジェクトでラップされる
    const count = ref('')
    const doubleCount = computed(() => count.value * 2)
    const increment = () => count.value++

  return {
    count,
    doubleCount,
    increment,
  }
}
