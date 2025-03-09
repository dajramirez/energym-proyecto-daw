import { ref } from "vue";

export function useFormErrors() {
    const error = ref([]);

    const setErrors = (errors) => {
        if (error.response.status === 422) {
            errors.value = Object.values(error.response.data.errors).flat();
        } else {
            errors.value = ["Error en la solicitud"];
        }
    };

    const clearErrors = () => {
        error.value = [];
    };

    return {
        error,
        setErrors,
        clearErrors,
    };
}
