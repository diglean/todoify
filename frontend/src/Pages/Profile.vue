<template>
  <div id="main_form">
    <div id="main_info">
      <img
        id="profile_picture"
        :src="auth.user.profile_picture"
        alt="Profile picture"
      >
      &nbsp;
      <div>
        <h1>{{ auth.user.name }}</h1>
        <div id="secondary_info">
          <span class="badge badge-dark">{{ auth.user.tasks_qty }}</span>
          <div v-if="auth.user.type === 'regular'">
            <span class="badge badge-secondary">Usuário</span>
          </div>
          &nbsp;
          <div v-if="auth.user.type === 'admin'">
            <span class="badge badge-primary">Admin</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
  import http from '@/services/http.js';
  import { useAuth } from '@/stores/auth';
  import { onMounted, ref } from 'vue';

  const auth = useAuth();
</script>

<style>
  #profile_picture {
    max-width: 100px;
    border-radius: 50%;
  }

  #main_info {
    display: flex;
    flex-direction: row;
    align-items: center;
  }

  #secondary_info {
    display: flex;
    flex-direction: row;
    align-items: center
  }
</style>