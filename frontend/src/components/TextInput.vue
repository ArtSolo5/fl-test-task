<script setup>
const props = defineProps({
  placeholder: {
    type: String,
    default: '',
  },
  name: {
    type: String,
    required: true,
  },
  modelValue: {
    type: String,
    default: '',
  },
});

const emit = defineEmits(['update:modelValue']);
</script>

<template>
  <input
    class="w-full px-4 py-3 border border-[#D1D1D1] bg-white font-normal text-[17px] leading-6 tracking-[-0.01em]"
    :placeholder="placeholder"
    type="text" 
    :name="name"
    :id="name" 
    :value="modelValue" 
    @input="emit('update:modelValue', $event.target.value)"
  >
</template>