<script setup>
import { ref, watch, onMounted } from 'vue';
import IntlTelInput from "intl-tel-input/vue";
import "intl-tel-input/styles";

const props = defineProps({
  name: {
    type: String,
    required: true,
  },
  modelValue: {
    type: String,
    default: '',
  },
  error: {
    type: String,
    default: '',
  },
});

const emit = defineEmits(['update:modelValue']);

const number = ref('');
const isValid = ref(false);
const errorCode = ref('');

const phoneInputRef = ref(null);

onMounted(() => {
  number.value = props.modelValue;
});

watch(number, (newValue) => {
  emit('update:modelValue', newValue);
});

watch(() => props.modelValue, (newValue) => {
  if (newValue !== number.value) {
    number.value = newValue;
  }
});

const handleChangeValidity = (value) => {
  isValid.value = value;
};

const handleChangeErrorCode = (value) => {
  errorCode.value = value;
};

const isValidNumber = () => {
  return isValid.value;
};

defineExpose({
  isValidNumber
});
</script>

<template>
  <div class="w-full">
    <IntlTelInput
      v-model="number"
      class="w-full px-4 py-3 border border-[#D1D1D1] bg-white font-normal text-[17px] leading-6 tracking-[-0.01em]"
      ref="phoneInputRef"
      @changeValidity="handleChangeValidity"
      @changeErrorCode="handleChangeErrorCode"
      :options="{
        initialCountry: 'ua',
        preferredCountries: ['ua'],
        separateDialCode: true,
        utilsScript: 'https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.16/build/js/utils.js',
      }"
      :class="{ 'error': error }"
    />
    <div v-if="error" class="text-red-500 text-sm mt-1">{{ error }}</div>
  </div>
</template>

<style>
.iti {
  width: 100%;
}
</style>