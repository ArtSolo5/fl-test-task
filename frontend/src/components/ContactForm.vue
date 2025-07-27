<script setup>
import { ref } from 'vue';
import TextInput from './TextInput.vue';
import TheButton from './TheButton.vue';
import TheTextarea from './TheTextarea.vue';
import TheCheckbox from './TheCheckbox.vue';
import UploadFile from './UploadFile.vue';
const formData = ref({
  name: '',
  email: '',
  phone: '',
  message: '',
  consent: false,
});

const handleSubmit = () => {
  console.log(formData.value);
};
</script>

<template>
  <form @submit.prevent="handleSubmit" class="w-full max-w-[578px]">
    <h1 class="font-normal text-5xl leading-[54px] tracking-[-0.02em] mb-5">Надіслати резюме</h1>

    <TextInput 
      class="w-full mb-2"
      placeholder="Ім'я та прізвище" 
      name="name"
      v-model="formData.name" 
    />

    <TextInput
      class="w-full mb-2"
      placeholder="Ваш Email" 
      name="email" 
      v-model="formData.email" 
    />

    <TextInput 
      class="w-full mb-2"
      placeholder="Ваш номер телефону" 
      name="phone" 
      v-model="formData.phone" 
    />

    <TheTextarea 
      class="w-full mb-2"
      placeholder="Супровідний лист" 
      name="message" 
      v-model="formData.message" 
    />

    <TheCheckbox 
      class="w-full mb-5"
      label="Згода на обробку персональних даних" 
      name="consent" 
      v-model="formData.consent" 
    />

    <div class="w-full flex items-center justify-between">
      <UploadFile
        name="file"
        label="Додати резюме"
      />

      <TheButton type="submit" label="Надіслати" />
    </div>
  </form>
</template>