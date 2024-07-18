<template>
  <div
    class="modal fade"
    :id="props.componentId"
    data-backdrop="static"
    data-keyboard="false"
    tabindex="-1"
    aria-labelledby="staticBackdropLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">
            <div v-if="task.id">{{ createdTask.name }}</div>
            <div v-else>Criar nova tarefa</div>
          </h5>
          &nbsp;
          <div v-if="createdTask.status === 'done'">
            <span class="badge badge-success">Concluído</span>
          </div>
          <div v-if="createdTask.status === 'doing'">
            <span class="badge badge-primary">Fazendo</span>
          </div>
          <div v-else-if="createdTask.status === 'pending'">
            <span class="badge badge-warning">Pendente</span>
          </div>
          <div v-else-if="createdTask.status === 'canceled'">
            <span class="badge badge-danger">Cancelado</span>
          </div>
          <div v-else-if="createdTask.status === 'overdue'">
            <span class="badge badge-danger">Vencido</span>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form
            @submit.prevent="createTask(task.id)"
            :id="'check-' + props.componentId + '-task-form'"
          >
            <div class="row form-group">
              <div class="col-xs-12 col-sm-6">
                <label for="task_name">Nome</label>
                <input
                  type="text"
                  class="form-control"
                  id="task_name"
                  placeholder="Nome da tarefa"
                  v-model="task.name"
                  required
                  :disabled="!auth.isAdmin()"
                />
              </div>
              <div class="col-xs-12 col-sm-6">
                <label for="assigned_to">Categoria</label>
                <br />
                <select
                  class="custom-select"
                  v-model="task.category"
                  required
                  :disabled="!auth.isAdmin()"
                >
                  <option value="chore">Tarefa</option>
                  <option value="feature">Implementação</option>
                  <option value="fix">Conserto</option>
                  <option value="service_request">Pedido de tarefa</option>
                </select>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-xs-12 col-sm-6">
                <label for="task_assigned_to">Responsável</label>
                <select
                  class="custom-select"
                  id="task_assigned_to"
                  v-model="task.assigned_to"
                  :disabled="!auth.isAdmin()"
                >
                  <option
                    v-for="(user, index) in users"
                    :value="user.id"
                  >
                    {{ user.name }}
                  </option>
                </select>
              </div>
              <div class="col-xs-12 col-sm-6">
                <label for="task_overdue_date">Vence em</label>
                <br />
                <input
                  type="datetime-local"
                  v-model="task.overdue_date"
                  required 
                  id="task_overdue_date"
                  :disabled="!auth.isAdmin()"
                />
              </div>
            </div>
            <div v-if="task.id" class="text-center">
              <label for="task_status">Atualizar estado da tarefa</label>
              <select
                class="custom-select"
                id="task_status"
                v-model="task.status"
                :disabled="task.status === 'canceled' && !auth.isAdmin()"
              >
                <option value="canceled" :disabled="!auth.isAdmin()">Cancelado</option>
                <option value="doing">Fazendo</option>
                <option value="done">Feito</option>
                <option value="pending">Pendente</option>
              </select>
            </div>
            <br />
            <div class="row form-group">
              <div class="col-sm-12">
                <label for="task_description">Descrição</label>
                <textarea
                  class="form-control"
                  id="task_description"
                  placeholder="Descrição da tarefa"
                  v-model="task.description"
                  style="resize: none"
                  rows="4"
                  maxlength="255"
                  :disabled="!auth.isAdmin()"
                ></textarea>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            data-dismiss="modal"
            @click="resetTask"
          >
            Cancelar
          </button>
          <div v-if="!task.id">
            <button
              type="submit"
              class="btn btn-primary"
              :form="'check-' + props.componentId + '-task-form'"
            >
              Criar
            </button>
          </div>
          <div v-else>
            <div>
              <button
                type="submit"
                class="btn btn-primary"
                :form="'check-' + props.componentId +'-task-form'"
              >
              <div>
                Atualizar
              </div>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <Toast />
</template>

<script setup>
import { onMounted, reactive, ref, watch } from 'vue'
import http from '@/services/http.js'
import { useAuth } from '@/stores/auth';
import Toast from '@/components/Toast.vue';

const auth = useAuth();

const taskDefaultValues = {
  id: '',
  name: '',
  category: '',
  assigned_to: '',
  status: '',
  overdue_date: '',
  description: '',
  user_id: auth?.user?.id,
};

const task = reactive(taskDefaultValues);

const createdTask = ref({});
const users = ref([{}]);

const props = defineProps({
  task: Object,
  componentId: String,
});

watch(props, () => {
  Object.assign(task, props.task);
  createdTask.value = props.task;
});

onMounted(() => {
  resetTask();
  getUsers();
})

async function getUsers() {
  const { data } = await http.get('/user/list')

  users.value = data.users;
}

async function createTask(id = null) {
  try {
    if (id !== null && id !== '') {
      const { data } = await http.put('/task/update', task);
      createdTask.value = data.task;
    } else {
      const { data } = await http.post('/task/create', task);

      task.id = data.task.id;
      createdTask.value = data.task;
      Toast.notify('success', 'Tarefa criada com sucesso!');
    }

  } catch (error) {
    console.log(error?.response?.data);
  }
}

function resetTask() {
  Object.assign(task, taskDefaultValues);
  createdTask.value = taskDefaultValues;
}
</script>
