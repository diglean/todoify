<template>
  <div
    class="modal fade"
    :id="'user-' + props.componentId"
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
            <div v-if="user.id">Editar usuário</div>
            <div v-else>Criar novo usuário</div>
          </h5>
        </div>
        <div class="modal-body">
          <form @submit.prevent="createUser(user.id)" :id="'check-' + props.componentId + '-user-form'">
            <div class="row form-group">
              <div class="col-xs-12 col-sm-12">
                <img
                  v-if="user?.profile_picture_url"
                  :src="user.profile_picture_url"
                  alt="Profile picture"
                  class="profile_picture"
                >
              </div>
            </div>
            <div class="row form-group">
              <div class="col-xs-12 col-sm-6">
                <label for="name">Nome Completo</label>
                <input
                  type="text"
                  class="form-control"
                  id="name"
                  placeholder="Digite seu Nome"
                  v-model="user.name"
                  required
                />
              </div>
              <div class="col-xs-12 col-sm-6">
                <label for="email">Email</label>
                <input
                  type="text"
                  class="form-control"
                  id="email"
                  aria-describedby="emailHelp"
                  placeholder="Digite seu melhor email"
                  v-model="user.email"
                  required
                />
              </div>
            </div>
            <div class="row form-group">
              <div class="col-xs-12 col-sm-6">
                <label for="birth_date">Data de Nascimento</label>
                <br />
                <input
                  type="date"
                  v-model="user.birth_date"
                  id="birth_date"
                />
              </div>
              <div class="col-xs-12 col-sm-6">
                <label for="birth_date">Tipo de usuário</label>
                <br />
                <select
                  class="custom-select"
                  v-model="user.type"
                  required
                  :disabled="!auth.isAdmin()"
                >
                  <option value="admin">Administrador</option>
                  <option value="regular">Comum</option>
                </select>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="resetUser">
            Cancelar
          </button>
          <div v-if="!user.id">
            <button
              type="submit"
              class="btn btn-primary"
              :form="'check-' + props.componentId + '-user-form'"
            >
              Criar
            </button>
          </div>
          <div v-else>
            <div>
              <button
                type="submit"
                class="btn btn-primary"
                :form="'check-' + props.componentId + '-user-form'"
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
import { onMounted, reactive, ref, watch } from 'vue';
import http from '@/services/http.js';
import { useAuth } from '@/stores/auth';
import Toast from '@/components/Toast.vue';

const auth = useAuth();

const userDefaultValues = {
  id: '',
  name: '',
  email: '',
  birth_date: '',
  type: '',
  password: '',
  confirm_password: '',
  user_id: auth?.user?.id,
};

const user = reactive(userDefaultValues);

const createdUser = ref({});

const props = defineProps({
  user: Object,
  componentId: String,
});

watch(props, () => {
  Object.assign(user, props.user);
  createdUser.value = props.user;
});


async function createUser(id = null) {
  console.log(id);
  try {
    if (id !== null && id !== '') {
      const { data } = await http.put('/user/update', user);
      createdUser.value = data.user;
    } else {
      const { data } = await http.post('/user/create', user);

      user.id = data.user.id;
      createdUser.value = data.user;
    }

  } catch (error) {
    console.log(error?.response?.data);
  }
}

function resetUser() {
  Object.assign(user, userDefaultValues);
  createdUser.value = userDefaultValues;
}
</script>

<style>
.profile_picture {
  max-width: 100px;
  border-radius: 50%;
}
</style>