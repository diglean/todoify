<template>
  <div class="main_content text-center">
    <h1 v-if="auth.isAdmin()">Listagem de tarefas</h1>
    <h1 v-else>Listagem de tarefas atribuídas a você.</h1>
    <div class="table-responsive">
      <TasksTable />
    </div>
  </div>
</template>

<script setup>
import TasksTable from '../components/TasksTable.vue';
import { useAuth } from '@/stores/auth';

const auth = useAuth();
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
