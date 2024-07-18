<template>
  <div id="main_form">
    <h2>Faça seu login</h2>
    <span
      >ou
      <RouterLink type="span" class="primary" to="/register"> Registre-se agora </RouterLink>
    </span>
    <form @submit.prevent="login" id="check-login-form">
      <br />
      <div class="form-group">
        <label for="email">Email</label>
        <input
          type="email"
          class="form-control"
          placeholder="Digite seu email"
          v-model="user.email"
        />
      </div>
      <div class="form-group">
        <label for="password">Senha</label>
        <input
          type="password"
          class="form-control"
          placeholder="Digite sua senha"
          v-model="user.password"
        />
      </div>
      <div class="text-center">
        <button type="submit" class="btn btn-primary btn-lg" form="check-login-form">Entrar</button>
      </div>
    </form>
  </div>
</template>

<style>
#main_form {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  margin-top: 10%;
}
</style>

<script setup>
import http from '@/services/http.js'
import { reactive } from 'vue'
import { useAuth } from '@/stores/auth.js'
import { useRouter } from 'vue-router'

const auth = useAuth()
const router = useRouter()

const user = reactive({
  email: '',
  password: ''
})

async function login() {
  try {
    const { data } = await http.post('/auth/login', user)

    auth.setToken(data.token)
    auth.setUser(data.user)

    router.push({ name: 'landingPage' })
  } catch (error) {
    console.log(error?.response?.data)
  }
}
</script>
