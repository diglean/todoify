<template>
  <TaskModal :task="taskDataRef" componentId="edit"/>
  <div class="table-responsive">
    <table class="table table-bordered">
      <div v-if="content?.length > 0" class="w-100 d-block d-md-table">
        <thead>
          <tr>
            <th colspan="3" scope="col">
              <label for="name">Busque por tarefas</label>
            </th>
            <th colspan="4" scope="col">
              <input
                type="text"
                class="form-control"
                id="name"
                placeholder="Nome da tarefa"
                v-model="taskSearch.name"
                required
              />
            </th>
          </tr>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Descrição</th>
            <th scope="col">Categoria</th>
            <th scope="col" v-if="auth.isAdmin()">Responsável</th>
            <th scope="col">Estado</th>
            <th scope="col">Vence(u) em:</th>
            <th scope="col">Ação</th>
          </tr>
        </thead>
        <tbody>
          <tr scope="row" v-for="(item, index) in content" :key="index">
            <td>{{ item.id }}</td>
            <td>{{ item.name }}</td>
            <td><span class="d-inline-block text-truncate" style="max-width: 100px;">{{ item.description }}</span></td>
            <td v-if="item.category === 'chore'">Tarefa</td>
            <td v-if="item.category === 'feature'">Implementação</td>
            <td v-if="item.category === 'fix'">Conserto</td>
            <td v-if="item.category === 'service_request'">Requisição de serviço</td>
            <td v-if="auth.isAdmin()">{{ item?.user?.name }}</td>
            <td v-if="item.status === 'done'">
              <span class="badge badge-success">Concluído</span>
            </td>
            <td v-if="item.status === 'doing'">
              <span class="badge badge-primary">Fazendo</span>
            </td>
            <td v-else-if="item.status === 'pending'">
              <span class="badge badge-warning">Pendente</span>
            </td>
            <td v-else-if="item.status === 'canceled'">
              <span class="badge badge-danger">Cancelado</span>
            </td>
            <td v-else-if="item.status === 'overdue'">
              <span class="badge badge-danger">Vencido</span>
            </td>
            <td>{{ formatDate(item.overdue_date, 'DD/MM/Y HH:mm') }}</td>
            <td>
              <button
                data-toggle="modal"
                data-target="#edit"
                class="btn btn-primary btn-sm"
                @click="showDetails(item)"
              >
                <BIconEyeFill />
              </button>
            </td>
          </tr>
        </tbody>
      </div>
      <div v-else>
        Nenhum resultado encontrado
      </div>
    </table>
  </div>
  <div class="text-center">
    <Pagination :source="pagination" @navigate="getTasks"/>
  </div>
</template>

<script setup>
  import { onMounted, reactive, ref, toRaw, watch } from 'vue';
  import {formatDatetime} from '@/Lib/FormatDate';
  import { useAuth } from '@/stores/auth';

  import Pagination from '@/components/Pagination.vue';
  import http from '@/services/http.js';
  import TaskModal from './TaskModal.vue';

  const auth = useAuth()
  const content = ref([{}]);
  const pagination = ref('');
  const taskSearch = reactive({ name: '' });

  onMounted(() => {
    getTasks();
  });

  watch(taskSearch, () => {
    setTimeout(() => {
      getTasks();
    }, 1000)
  })

  function formatDate(date, format) {
    return formatDatetime(date, format);
  }

  async function getTasks(page = 1) {
    let url = `/task/list?page=${page}`;

    if (!auth.isAdmin()) {
      url += `&user_id=${auth.user.id}`;
    }

    url+= `&search=${taskSearch.name}`;

    const { data } = await http.get(url, {
      headers: { 'Access-Control-Allow-Origin': '*'}
    });

    content.value = data.data;
    pagination.value = data;
  }

  const taskDataRef = ref({});

  function showDetails(task) {
    taskDataRef.value = toRaw(task);
  }
</script>