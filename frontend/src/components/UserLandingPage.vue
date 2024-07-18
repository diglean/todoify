<template>
  <div>
    <h1 class="main_label text-center">Olá, {{ auth.firstName }}.</h1>
    <h2 class="text-center">Até agora você:</h2>
    <br />
    <div class="row widget-row">
      <div class="col-md-4">
        <Widget
          upperText="Concluiu"
          :qty="widgetData.doneTasks"
          lowerText="Tarefas"
          color="text-success"
        />
      </div>
      <div class="col-md-4">
        <Widget
          upperText="Atribuiu"
          :qty="widgetData.assignedTasks"
          lowerText="Tarefas"
          color="text-secondary"
        />
      </div>
      <div class="col-md-4">
        <Widget
          upperText="Tem"
          :qty="widgetData.doingTasks"
          lowerText="Tarefa(s) sendo Feita(s)"
          color="text-primary"
        />
      </div>
    </div>
    <br />
    <h2 class="text-center">Porém...</h2>
    <div class="row widget-row">
      <div class="col-md-6">
        <Widget
          upperText="Tem"
          :qty="widgetData.overdueTasks"
          lowerText="Tarefa(s) vencida(s)"
          color="text-danger"
        />
      </div>
      <div class="col-md-6">
        <Widget
          upperText="Tem"
          :qty="widgetData.pendingTasks"
          lowerText="Tarefas pendente(s)"
          color="text-warning"
        />
      </div>
    </div>
  </div>
</template>

<script setup>
import { useAuth } from '@/stores/auth'
import Widget from '@/components/Widget.vue'
import http from '@/services/http.js';
import { onMounted, ref } from 'vue';

const auth = useAuth();
const widgetData = ref([{}]);

onMounted(() => {
  getWidgetData();
})

async function getWidgetData()
{
  const { data } = await http.get(`task/get-widget-data?user_id=${auth.user.id}`);

  widgetData.value = data;
}

</script>

<style>
.main_label {
  margin-top: 10%;
  font-weight: 900;
}
</style>
