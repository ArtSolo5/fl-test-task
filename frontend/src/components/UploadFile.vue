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
});

const file = ref(null);

const handleFileChange = (event) => {
  file.value = event.target.files[0].name;
};
</script>

<template>
  <div>
    <label :for="name" class="flex items-center gap-2 font-medium text-base leading-8 tracking-[0%] text-[#2B2C38] border border-[#BFC0C3] px-[38px] py-2">
      <input class="hidden" type="file" :name="name" :id="name" @change="handleFileChange" />
      {{ label }}
    </label>
  </div>
</template>

