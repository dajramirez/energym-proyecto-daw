<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';
import { useAuthStore } from '../../stores/auth';
import { useFormErrors } from '../../composables/useFormErrors';

const { setErrors } = useFormErrors()
const router = useRouter()

const form = ref({
  login: '',
  password: ''
})

const errors = ref([])

const submitForm = async () => {
  try {
    const response = await axios.post('/login', form.value)

    router.push(response.data.redirect)

    useAuthStore().setUser(response.data.user)
  } catch (error) {
    setErrors(error)
  }
}
</script>

<template>
  <div>
    <h1>Iniciar sesión</h1>

    <div v-if="errors.length" class="alert alert-danger">
      <ul>
        <li v-for="error in errors" :key="error">{{ error }}</li>
      </ul>
    </div>
  </div>

  <form @submit.prevent="submitForm">
    <div class="form-group">
      <label for="login">Usuario o correo electrónico</label>
      <input type="text" id="login" v-model="form.login" required autofocus>
    </div>
    <div class="form-group">
      <label for="password">Contraseña</label>
      <input type="password" id="password" v-model="form.password" required>
    </div>
    <button type="submit">Iniciar sesión</button>
  </form>
</template>