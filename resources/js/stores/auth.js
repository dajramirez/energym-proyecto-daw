import { ref } from "vue";
import { defineStore } from "pinia";

export const useAuthStore = defineStore("auth", () => {
    const user = ref(null);
    const isAuthenticated = ref(false);

    function setUser(userData) {
        user.value = userData;
        isAuthenticated.value = true;
    }
    function logout() {
        user.value = null;
        isAuthenticated.value = false;
    }
});
