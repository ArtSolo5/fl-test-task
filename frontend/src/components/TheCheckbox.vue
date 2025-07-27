<script setup>
const props = defineProps({
  label: {
    type: String,
    required: true,
  },
  name: {
    type: String,
    required: true,
  },
  modelValue: {
    type: Boolean,
    default: false,
  },
});

const emit = defineEmits(['update:modelValue']);
</script>

<template>
  <label :for="name" class="flex items-center gap-2">
    <input
      class="w-5 h-5 border border-[#D1D1D1] bg-white rounded-sm"
      type="checkbox" 
      :name="name" 
      :id="name" 
      :value="modelValue" 
      @input="emit('update:modelValue', $event.target.checked)"
    >
    {{ label }}
  </label>
</template>
