<template>
  <UserModal :user="userDataRef" componentId="edit"/>
  <div class="table-responsive">
    <table class="table table-bordered">
      <div v-if="content?.length > 0" class="w-100 d-block d-md-table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Tipo</th>
            <th scope="col">Dt Nascimento</th>
            <th scope="col">Ação</th>
          </tr>
        </thead>
        <tbody>
          <tr scope="row" v-for="(item, index) in content" :key="index">
            <td>{{ index + 1 }}</td>
            <td>{{ item.name }}</td>
            <td>{{ item.email }}</td>
            <td v-if="item.type === 'regular'">
              <span class="badge badge-warning">Usuário</span>
            </td>
            <td v-if="item.type === 'admin'">
              <span class="badge badge-primary">Admin</span>
            </td>
            <td>{{ formatDate(item.birth_date, 'DD/MM/Y') }}</td>
            <td>
              <button
                data-toggle="modal"
                data-target="#user-edit"
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
    <Pagination :source="pagination" @navigate="getUsers"/>
  </div>
</template>

<script setup>
  import { onMounted, reactive, ref, toRaw } from 'vue';
  import http from '@/services/http.js';
  import {formatDatetime} from '@/Lib/FormatDate';

  import Pagination from '@/components/Pagination.vue';
  import UserModal from '@/components/UserModal.vue';

  onMounted(() => {
    getUsers();
  });

  const content = ref([{}]);
  const pagination = ref('');

  function formatDate(date, format) {
    return formatDatetime(date, format);
  }

  async function getUsers(page = 1) {
    let url = `/user/list?page=${page}`;

    const { data } = await http.get(url, {
      headers: { 'Access-Control-Allow-Origin': '*'}
    });

    content.value = data.paginatedUsers.data;
    pagination.value = data.paginatedUsers;
  }

  const userDataRef = ref({});

  function showDetails(user) {
    userDataRef.value = toRaw(user);
  }
</script>