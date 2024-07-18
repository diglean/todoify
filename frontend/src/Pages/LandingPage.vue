<template>
  <div v-if="auth.isAuthenticated()">
    <UserLandingPage />
  </div>
  <div v-else>
    <div class="text-center">
      <h1 id="primary_label">Bem Vindo!</h1>
      <span id="secondary_label"
        >Use o Todoify para facilitar sua organização do dia a dia &#128521;</span
      >
      <br />
      <br />
      <RouterLink type="button" class="btn btn-primary btn-lg" to="/login"> Entrar </RouterLink>
    </div>
  </div>
</template>

<script setup>
import UserLandingPage from '@/components/UserLandingPage.vue'
import { RouterLink } from 'vue-router'
import { useAuth } from '@/stores/auth.js'

const auth = useAuth()
</script>

<style>
#primary_label {
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: center;
  margin-top: 15%;
  font-size: 85px;
  font-weight: 900;
}

#secondary_label {
  font-size: 20px;
}

@media (max-width: 575.98px) {
  #primary_label {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    margin-top: 50%;
    font-size: 70px;
    font-weight: 900;
  }
}
</style>
