<template>
  <div class="mt-4 bg-blue-200">
    <text-input
      v-model="form.firstName"
      name="firstName"
      label="FIRST NAME" />
    <text-input
      v-model="form.lastName"
      name="lastName"
      label="LAST NAME" />
    <text-input
      v-model="form.email"
      class="bg-blue-200 border-none"
      name="email"
      label="EMAIL"
      type="email" />
    <text-input
      v-model.number="form.password"
      class="bg-blue-200 border-none"
      name="password"
      label="PASSWORD"
      type="password"
      placeholder="******************" />
    <select-input
      v-model="form.gender"
      :options="options"
      name="gender"
      label="GENDER" />
    <div class="m-3">
      <default-button>
        Button
      </default-button>
    </div>
  </div>
</template>

<script>
import { usePage, ref, onMounted, computed, reactive, toRefs, isRef } from "vue";
import { hoge } from '../actions/hoge'
import TextInput from './Components/TextInput'
import SelectInput from './Components/SelectInput'
import DefaultButton from './Components/Button'

export default {
  name: 'Task',
  components: {
    TextInput,
    SelectInput,
    DefaultButton,
  },
  setup() {
    const form = reactive({
      firstName: '',
      lastName: '',
      email: '',
      password: '',
      gender: '不明',
    })
    const options = ref(['不明', '男', '女'])

    return {
      form,
      options,
    }
  }
}
</script>
