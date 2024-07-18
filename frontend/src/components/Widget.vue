<template>
  <div class="main_div text-center">
    <div>
      <div><h5 :class="color">{{ upperText }}</h5></div>
      <div><h5 :class="color">{{ qty }}</h5></div>
      <div><h5 :class="color">{{ lowerText }}</h5></div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Widget',
  props: {
    upperText: {
      type: String,
      required: true
    },
    qty: {
      type: String,
      required: true
    },
    lowerText: {
      type: String,
      required: false
    },
    color: {
      type: String,
      required: false
    }
  }
}
</script>

<style>
</style>
