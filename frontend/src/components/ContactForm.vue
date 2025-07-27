<script setup>
import { ref } from 'vue';
import { useForm } from 'vee-validate';
import * as yup from 'yup';
import TextInput from './TextInput.vue';
import PhoneInput from './PhoneInput.vue';
import TheButton from './TheButton.vue';
import TheTextarea from './TheTextarea.vue';
import TheCheckbox from './TheCheckbox.vue';
import UploadFile from './UploadFile.vue';

const schema = yup.object({
  name: yup
    .string()
    .required('Ім\'я обов\'язкове')
    .max(35, 'Ім\'я не може бути довшим за 35 символів'),
  email: yup
    .string()
    .required('Email обов\'язковий')
    .email('Введіть коректний email')
    .max(35, 'Email не може бути довшим за 35 символів'),
  phone: yup
    .string()
    .required('Телефон обов\'язковий')
    .max(15, 'Номер телефону не може бути довшим за 15 цифр'),
  message: yup
    .string()
    .max(500, 'Повідомлення не може бути довшим за 500 символів'),
  consent: yup
    .boolean(),
  file: yup
    .mixed()
    .when('consent', {
      is: true,
      then: (schema) => schema
        .required('Файл обов\'язковий, якщо відмічено згоду')
        .test('fileType', 'Дозволені тільки зображення', (value) => {
          if (!value) return false;
          return ['image/jpeg', 'image/png', 'image/gif', 'image/bmp', 'image/tiff'].includes(value.type);
        })
        .test('fileSize', 'Розмір файлу не може перевищувати 2MB', (value) => {
          if (!value) return false;
          return value.size <= 2 * 1024 * 1024;
        }),
      otherwise: (schema) => schema.nullable()
    })
});

const { errors, values, setFieldValue, resetForm, validate } = useForm({
  validationSchema: schema,
  initialValues: {
    name: '',
    email: '',
    phone: '',
    message: '',
    consent: false,
    file: null
  },
  validateOnMount: false,
  validateOnBlur: false,
  validateOnChange: false
});

const isSubmitting = ref(false);
const hasSubmitted = ref(false);
const phoneInputRef = ref(null);

const submitForm = async (values) => {
  if (isSubmitting.value) return;
  
  hasSubmitted.value = true;
  isSubmitting.value = true;
  
  try {
    const formData = new FormData();
    formData.append('name', values.name);
    formData.append('email', values.email);
    formData.append('phone', values.phone);
    formData.append('message', values.message || '');
    formData.append('consent', values.consent ? '1' : '0');
    
    if (values.file) {
      formData.append('file', values.file);
    }

    const response = await fetch('http://localhost:8000/api/submissions', {
      method: 'POST',
      body: formData,
    });

    if (response.ok) {
      alert('Форму успішно надіслано!');
      resetForm();
      hasSubmitted.value = false;
    } else {
      alert('Помилка при надсиланні форми');
    }
  } catch (error) {
    alert('Помилка при надсиланні форми');
  } finally {
    isSubmitting.value = false;
  }
};

const handleFormSubmit = async () => {
  const { valid } = await validate();
  
  if (valid) {
    await submitForm(values);
  } else {
    hasSubmitted.value = true;
  }
};

const handleFileChange = (file) => {
  setFieldValue('file', file);
};

const updateName = (value) => setFieldValue('name', value);
const updateEmail = (value) => setFieldValue('email', value);
const updatePhone = (value) => setFieldValue('phone', value);
const updateMessage = (value) => setFieldValue('message', value);
const updateConsent = (value) => setFieldValue('consent', value);

const showError = (fieldName) => {
  return hasSubmitted.value ? errors.value[fieldName] : '';
};
</script>

<template>
  <form @submit.prevent="handleFormSubmit" class="w-full max-w-[578px]">
    <h1 class="font-normal text-5xl leading-[54px] tracking-[-0.02em] mb-5">Надіслати резюме</h1>

    <div class="w-full mb-2">
      <TextInput 
        placeholder="Ім'я та прізвище" 
        name="name"
        :model-value="values.name"
        @update:model-value="updateName"
        :error="showError('name')"
      />
    </div>

    <div class="w-full mb-2">
      <TextInput
        placeholder="Ваш Email" 
        name="email" 
        :model-value="values.email"
        @update:model-value="updateEmail"
        :error="showError('email')"
      />
    </div>

    <div class="w-full mb-2">
      <PhoneInput 
        name="phone" 
        :model-value="values.phone"
        @update:model-value="updatePhone"
        :error="showError('phone')"
        ref="phoneInputRef"
      />
    </div>

    <div class="w-full mb-2">
      <TheTextarea 
        placeholder="Супровідний лист" 
        name="message" 
        :model-value="values.message"
        @update:model-value="updateMessage"
        :error="showError('message')"
      />
    </div>

    <div class="w-full mb-5">
      <TheCheckbox 
        label="Згода на обробку персональних даних" 
        name="consent" 
        :model-value="values.consent"
        @update:model-value="updateConsent"
        :error="showError('consent')"
      />
    </div>

    <div class="w-full flex items-center justify-between">
      <UploadFile
        name="file"
        label="Додати резюме"
        @file-change="handleFileChange"
        :error="showError('file')"
      />

      <TheButton class="disabled:opacity-50" type="submit" :disabled="isSubmitting" label="Надіслати" />
    </div>
  </form>
</template>

<style>
 .iti {
  width: 100%;
 }
</style>
