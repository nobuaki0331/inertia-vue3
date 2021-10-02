<template>
  {{ books.value }}
  <input
    v-model="bookName" />
  <ul
    v-for="(book, i) in books"
    :key="i">
    <li class="text-red-500">{{ book }}</li>
  </ul>
  <button
    class="bg-light-blue-300 rounded-md text-white"
    @click.prevent="onIncrementButtonClicked">
    増減
  </button>
  {{ hoge }}
</template>

<script>
import { ref, watch, reactive } from 'vue'

export default {
  name: 'Tailwind',
  setup() {
    const books = ref(['book1', 'book2', 'book3'])
    const obj1 = reactive({
      name: 'ほげ',
    })
    const bookName = ref('')
    const hoge = ref('')
    const onIncrementButtonClicked = () => {
      obj1['book'] = bookName.value
    }
    watch(
      () => obj1,
      (newVal) => {
        console.log(newVal.name)
      },
      { deep: true }
    )

    return {
      obj1,
      hoge,
      books,
      bookName,
      onIncrementButtonClicked,
    }
  },
}
</script>
