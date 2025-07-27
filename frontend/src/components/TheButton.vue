<script setup>
  const props = defineProps({
    label: {
      type: String,
      required: true,
    },
    type: {
      type: String,
      default: 'button',
    },
  });
</script>

<template>
  <button 
    :type="type" 
    class="rounded px-[38px] py-2 bg-[#2B2C38] font-medium text-[17px] leading-8 tracking-[0%] text-white"
  >
    {{ label }}
  </button>
</template>