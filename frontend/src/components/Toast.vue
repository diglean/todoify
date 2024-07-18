<template></template>
<script setup>
  import { defineProps } from 'vue';
  import { toast } from 'vue3-toastify';
  import 'vue3-toastify/dist/index.css';

  const options = {
    'position': toast.POSITION.TOP_RIGHT,
    'autoClose': 2000,
    'closeOnClick': true,
    'type': 'default',
  };

  const props = defineProps({
    type: String,
    message: String,
  })
  
  const notify = (type, message) => {
    options['type'] = type;

    toast(message, options);
  }

  if (props?.message) {
    notify(props.type, props.message)
  }

</script>