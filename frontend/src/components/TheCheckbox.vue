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
  error: {
    type: String,
    default: '',
  },
});

const emit = defineEmits(['update:modelValue']);
</script>

<template>
  <div>
    <label :for="name" class="flex items-center gap-2">
      <input
        class="w-5 h-5 border border-[#D1D1D1] bg-white rounded-sm"
        :class="{ 'border-red-500': error }"
        type="checkbox" 
        :name="name" 
        :id="name" 
        :checked="modelValue" 
        @input="emit('update:modelValue', $event.target.checked)"
      >
      {{ label }}
    </label>
    <div v-if="error" class="text-red-500 text-sm mt-1">{{ error }}</div>
  </div>
</template>
