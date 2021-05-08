<template>
  <div class="p-16 bg-blue-100">
    <div class="p-4 bg-white rounded-md">
      <div
        v-if="isConfirmation"
        class="py-4 pl-3">
        <h3>■アカウント削除確認</h3>
        <p class="text-sm text-red-500">アカウントの削除を行います。削除後はデータを元に戻すことができません。</p>
      </div>
      <text-input
        v-model="form.name"
        name="Name"
        label="NAME"
        :disabled="disabled" />
      <p class="pl-4 text-xs text-red-500">変更前:{{ oldFormName }}</p>
      <text-input
        v-model="form.email"
        class="border-none"
        name="email"
        label="EMAIL"
        type="email"
        :disabled="disabled" />
      <p class="pl-4 text-xs text-red-500">変更前:{{ oldFormEmail }}</p>
      <text-input
        v-model.number="form.password"
        class="border-none"
        name="password"
        label="PASSWORD"
        type="password"
        placeholder="******************"
        :disabled="disabled" />
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
        label="GENDER"
        :disabled="disabled" />
      <div class="flex justify-between p-3">
        <secoundary-button
          @click="onReturnButtonClicked">
          戻る
        </secoundary-button>
        <default-button
          :bg-color="bgColor"
          @click="onSaveButtonClicked">
          {{ buttonText }}
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
    isConfirmation: {
      type: Boolean,
      default: false,
    },
  },
  setup(props) {
    const disabled = props.isConfirmation ? true : false
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

    const buttonText = computed(() => {
      const { user, isNew, isConfirmation } = props
      if (isNew) return '保存'
      if (user && isConfirmation) return '削除'
      if (user) return '更新'
      return ''
    })
    const bgColor = computed(() => {
      const { user, isNew, isConfirmation } = props

      if (user && isConfirmation) {
        return 'bg-red-500 hover:bg-red-400'
      } else {
        return 'bg-blue-500 hover:bg-blue-400'
      }
    })
    const onSaveButtonClicked = () => {
      const { user, isNew, isConfirmation } = props
      if (photo.value) {
        form.image_url = photo.value.files[0]
      }
      if (isNew) {
        form.post(route('account.store'))
      } else if(user && isConfirmation) {
        form.delete(route('account.destroy', {
          'user' : props.user.id
        }))
      } else if(user) {
        form.put(route('account.update', {
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
      disabled,
      oldFormName,
      oldFormEmail,
      photo,
      photoPreview,
      updatePhotoPreview,
      form,
      options,
      buttonText,
      bgColor,
      onSaveButtonClicked,
      onReturnButtonClicked,
    }
  }
}
</script>
