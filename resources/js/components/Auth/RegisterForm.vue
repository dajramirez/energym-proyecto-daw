<script setup>
import axios from 'axios';
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useFormErrors } from '../../composables/useFormErrors';

const router = useRouter();
const { setErrors } = useFormErrors()

const form = ref({
    name: '',
    email: '',
    username: '',
    password: '',
    password_confirmation: '',
})

const errors = ref([])

const submitForm = async () => {
    try {
        const response = await axios.post('/register', form.value)

        router.push(response.data.redirect)
    } catch (error) {
        setErrors(error)
    }
}
</script>

<template>
    <div>
        <h1>Registro</h1>

        <div v-if="errors.length" class="alert alert-danger">
            <ul>
                <li v-for="error in errors" :key="error">{{ error }}</li>
            </ul>
        </div>

        <form @submit.prevent="submitForm">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" id="name" v-model="form.name" required autofocus>
            </div>
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" id="email" v-model="form.email" required>
            </div>
            <div class="form-group">
                <laber for="username">Nombre de usuario</laber>
                <input type="text" id="username" v-model="form.username" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" v-model="form.password" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirmar contraseña</label>
                <input type="password" id="password_confirmation" v-model="form.password_confirmation" required>
            </div>
            <button type="submit">Registrar</button>
        </form>
    </div>
</template>