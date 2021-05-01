<template>
  <div class="p-4 bg-blue-100">
    <text-input
      v-model="form.name"
      name="Name"
      label="NAME" />
    <text-input
      v-model="form.email"
      class="bg-blue-100 border-none"
      name="email"
      label="EMAIL"
      type="email" />
    <text-input
      v-model.number="form.password"
      class="bg-blue-100 border-none"
      name="password"
      label="PASSWORD"
      type="password"
      placeholder="******************" />
    <div class="p-4">
      <input
        type="file"
        ref="photo"
        name="image"
        @change="updatePhotoPreview" />
      <div
        class="mt-2"
        v-show="photoPreview">
        <img
          :src="photoPreview ?? form.image_url"
          class="rounded-full h-20 w-20 object-cover">
      </div>
    </div>
    <select-input
      v-model="form.gender"
      :options="options"
      name="gender"
      label="GENDER" />
    <div class="m-3">
      <default-button
        @click="onSaveButtonClicked">
        保存
      </default-button>
      <secoundary-button
        class="ml-4"
        @click="onReturnButtonClicked">
        戻る
      </secoundary-button>
    </div>
  </div>
</template>

<script>
import { usePage, ref, onMounted, computed, reactive, toRefs, isRef } from "vue";
import { hoge } from '../actions/hoge'
import TextInput from './Components/TextInput'
import SelectInput from './Components/SelectInput'
import DefaultButton from './Components/Button'
import { Inertia } from '@inertiajs/inertia'
import SecoundaryButton from '../Jetstream/SecondaryButton'

export default {
  name: 'Account',
  components: {
    TextInput,
    SelectInput,
    DefaultButton,
    SecoundaryButton,
  },
  props: {
    user: {
      type: Object,
      default: () => {},
    },
    isNew: {
      type: Boolean,
      default: false,
    },
  },
  setup(props) {
    const form = reactive(Inertia.form({
      _method: 'POST',
      name: '',
      email: '',
      password: '',
      image_url: '',
      gender: '不明',
    }))
    const options = ref(['不明', '男性', '女性'])
    const onSaveButtonClicked = () => {
      if (photo.value) {
        form.image_url = photo.value.files[0]
      }
      if (props.isNew) {
        form.post(route('account.store'))
      } else {
        form.post(route('account.update', {
          'user' : props.user.id
        }))
      }
    }
    const onReturnButtonClicked = () => {
      Inertia.get(route('home.index'))
    }

    const photo = ref(null)
    const photoPreview = ref(null)
    const updatePhotoPreview = () => {
      const reader = new FileReader();
      reader.onload = (e) => {
        photoPreview.value = e.target.result;
      };
      reader.readAsDataURL(photo.value.files[0]);
    }
    onMounted(() => {
      if (!props.isNew) {
        form._method = 'PUT'
        form.name = props.user.name
        form.email = props.user.email
        form.password = props.user.password
        form.gender = props.user.gender
        form.image_url = props.user.image_url
      }
    })

    return {
      photo,
      photoPreview,
      updatePhotoPreview,
      form,
      options,
      onSaveButtonClicked,
      onReturnButtonClicked,
    }
  }
}
</script>
