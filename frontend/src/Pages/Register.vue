<template>
  <div id="main_form">
    <h2>Faça seu Registro</h2>
    <form @submit.prevent="save" id="check-register-form">
      <div class="row form-group">
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
      <div class="row form-group">
        <label for="birth_date">Data de Nascimento</label>
        <br />
        <input type="date" v-model="user.birth_date" id="birth_date" />
      </div>
      <div class="row form-group">
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
      <div class="row form-group">
        <label for="password">Senha</label>
        <input
          type="text"
          class="form-control"
          id="password"
          placeholder="Digite sua senha"
          v-model="user.password"
          required
        />
      </div>
      <div class="row form-group">
        <label for="password">Confirmar Senha</label>
        <input
          type="text"
          class="form-control"
          id="password"
          placeholder="Confirme sua senha"
          v-model="user.confirm_password"
          required
        />
      </div>
      <div class="text-center">
        <button type="submit" class="btn btn-primary btn-lg" form="check-register-form">
          Continuar
        </button>
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
  margin-bottom: 10%;
}

#check-register-form {
  min-width: 200px;
}
</style>

<script setup>
import axios from 'redaxios';
import http from '@/services/http.js';
import { ref } from 'vue';

const user = ref({
  user: {
    id: '',
    name: '',
    birth_date: '',
    email: '',
    password: '',
    confirm_password: ''
  }
});

function save() {
  if (user.id === '') {
    saveData();
  } else {
    updateData();
  }
}
    
function saveData() {
  validateData()
  http.post(HOME + '/api/user/create', user);
}

function updateData() {
  http.post(HOME + '/api/user/update', user);
}

function validateData() {
  if (user.password !== user.confirm_password) {
    return alert('As senhas não condizem');
  }
}
</script>
