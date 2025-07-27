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
  error: {
    type: String,
    default: '',
  },
});

const emit = defineEmits(['update:modelValue']);
</script>

<template>
  <div>
    <textarea
      class="w-full px-4 py-3 border border-[#D1D1D1] bg-white font-normal text-[17px] leading-6 tracking-[-0.01em] resize-none"
      :class="{ 'border-red-500 bg-red-50': error }"
      :placeholder="placeholder"
      :name="name" 
      :id="name" 
      :value="modelValue" 
      @input="emit('update:modelValue', $event.target.value)"
    >
    </textarea>
    <div v-if="error" class="text-red-500 text-sm mt-1">{{ error }}</div>
  </div>
</template>