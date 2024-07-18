<template>
  <div class="input-group mb-3">
    <select class="custom-select" id="inputGroupSelect01" v-model="vmodel">
      <option selected></option>
      <option v-for="(item, index) in itens" :value="item.id">{{ item.name }}</option>
    </select>
  </div>
</template>

<script>
export default {
  props: {
    itens: {
      type: Array,
      required: true
    }
  }
}
</script>
