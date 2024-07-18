import { computed, ref } from 'vue'
import { defineStore } from 'pinia'
import http from '@/services/http.js'

export const useAuth = defineStore('auth', () => {
  const token = ref(localStorage.getItem('token'))
  const user = ref(JSON.parse(localStorage.getItem('user')))

  function setToken(tokenValue) {
    localStorage.setItem('token', tokenValue)
    token.value = tokenValue
  }

  function setUser(userValue) {
    localStorage.setItem('user', JSON.stringify(userValue))
    user.value = userValue
  }

  function isAuthenticated() {
    return token.value && user.value
  }

  function isAdmin() {
    return token.value && user.value && user.value.type === 'admin'
  }

  const fullName = computed(() => {
    return user?.value?.name
  })

  const firstName = computed(() => {
    return user?.value?.name.split(' ')[0]
  })

  const profilePicture = computed(() => {
    return user?.value?.profile_picture
  })

  async function checkToken() {
    try {
      const tokenAuth = 'Bearer ' + token.value
      const data = await http.get('/auth/check', {
        headers: {
          Authorization: tokenAuth
        }
      })

      return data
    } catch (error) {
      console.log(error.response)
    }
  }

  function clear() {
    localStorage.removeItem('token');
    localStorage.removeItem('user');
    token.value = '';
    user.value = '';
  }

  return {
    token,
    setToken,
    user,
    setUser,
    checkToken,
    isAuthenticated,
    fullName,
    firstName,
    profilePicture,
    isAdmin,
    clear,
  }
})
