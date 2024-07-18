<template>
  <div class="main_content text-center">
    <h1>Listagem de usuários.</h1>
    <div class="table-responsive">
      <UsersTable />
    </div>
  </div>
</template>

<script setup>
  import UsersTable from '@/components/UsersTable.vue';
</script>

<style>
.main_content {
  margin-top: 5%;
  padding-right: 5%;
  padding-left: 5%;
}

.main_content h1 {
  font-weight: 900;
}
</style>
