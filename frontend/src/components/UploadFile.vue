<script setup>
import { ref } from 'vue';

const props = defineProps({
  name: {
    type: String,
    required: true,
  },
  label: {
    type: String,
    required: true,
  },
  error: {
    type: String,
    default: '',
  },
});

const emit = defineEmits(['file-change']);

const file = ref(null);

const handleFileChange = (event) => {
  const selectedFile = event.target.files[0];
  file.value = selectedFile ? selectedFile.name : null;
  emit('file-change', selectedFile);
};
</script>

<template>
  <div class="relative">
    <label :for="name" class="flex items-center gap-2 font-medium text-base leading-8 tracking-[0%] text-[#2B2C38] border border-[#BFC0C3] px-[38px] py-2 cursor-pointer whitespace-nowrap">
      <input class="hidden" type="file" :name="name" :id="name" @change="handleFileChange" accept="image/*" />
      {{ file || label }}
    </label>
    <div v-if="error" class="text-red-500 text-sm mt-1 absolute top-full left-0 w-full">{{ error }}</div>
  </div>
</template>

