<template>
  <div class="p-16 bg-blue-100">
    <div class="p-4 bg-white rounded-md">
      <text-input
        v-model="form.name"
        name="Name"
        label="NAME"/>
      <p class="pl-4">変更前:{{ oldFormName }}</p>
      <text-input
        v-model="form.email"
        class="border-none"
        name="email"
        label="EMAIL"
        type="email" />
      <p class="pl-4">変更前:{{ oldFormEmail }}</p>
      <text-input
        v-model.number="form.password"
        class="border-none"
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
      <div class="flex justify-between p-3">
        <secoundary-button
          @click="onReturnButtonClicked">
          戻る
        </secoundary-button>
        <default-button
          @click="onSaveButtonClicked">
          保存
        </default-button>
      </div>
    </div>
  </div>
</template>

<script>
import { usePage, ref, onMounted, computed, reactive, toRefs, isRef, watch } from "vue";
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
    const form = props.isNew ?
    reactive(Inertia.form({
      _method: 'POST',
      name: '',
      email: '',
      password: '',
      image_url: '',
      gender: '不明',
    })) :
    reactive(Inertia.form({
      _method: 'PUT',
      name : props.user.name,
      email : props.user.email,
      password : props.user.password,
      gender : props.user.gender,
      image_url : props.user.image_url
    }))
    const options = ref(['不明', '男性', '女性'])

    const oldFormName = ref('')
    const oldFormEmail = ref('')
    watch(() => form.name, (newValue, oldValue) => (oldFormName.value = oldValue))
    watch(() => form.email, (newValue, oldValue) => (oldFormEmail.value = oldValue))

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

    return {
      oldFormName,
      oldFormEmail,
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
