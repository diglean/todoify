<template>
  <TaskModal componentId="create"/>
  <div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="navbar">
      <RouterLink class="navbar-brand" to="/">Todoify</RouterLink>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <RouterLink class="navbar-brand" to="/">Início</RouterLink>
          </li>
          <li class="nav-item" v-if="auth.isAuthenticated()">
            <RouterLink v-if=" ! auth.isAdmin()" class="navbar-brand" to="/list-tasks">Minhas Tarefas</RouterLink>
            <RouterLink v-else class="navbar-brand" to="/list-tasks">Tarefas</RouterLink>
          </li>
          <li class="nav-item" v-if="auth.isAdmin()">
            <RouterLink class="navbar-brand" to="/list-users">
                Usuários
            </RouterLink>
          </li>
          <li class="nav-item" v-if="auth.isAdmin()">
            <button
              data-toggle="modal"
              data-target="#create"
              class="navbar-brand btn btn-primary btn-sm"
            >
              Nova Tarefa
            </button>
          </li>
        </ul>

        <div>
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <template v-if="auth.isAuthenticated()">
                <RouterLink class="navbar-brand" to="/profile">
                  {{ auth.firstName }}
                  <img class="navbar_profile_picture" :src="auth.profilePicture" />
                </RouterLink>
                <Button class="btn btn-primary" @click="logout">
                  Sair
                </Button>
              </template>
              <template v-else="!auth.isAuthenticated()">
                <RouterLink class="nav-link" to="/login">Login</RouterLink>
              </template>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</template>

<style>
.navbar_profile_picture {
  max-width: 30px;
  border-radius: 50%;
}
</style>

<script setup>
import { RouterLink } from 'vue-router'
import TaskModal from '../components/TaskModal.vue'
import { useAuth } from '@/stores/auth.js';
import { useRouter } from 'vue-router';

const auth = useAuth();
const router = useRouter();

function logout() {
  auth.clear();

  router.push({ name: 'login' });
}
</script>
