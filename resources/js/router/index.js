import { createRouter, createWebHistory } from "vue-router";
import { useAuthStore } from "../stores/auth";
import Login from "../views/Auth/Login.vue";

const routes = [
    {
        path: "/login",
        name: "login",
        component: Login,
    },
    // {
    //     path: "/user.dashboard",
    //     component: UserDashboard,
    //     meta: { requiresAuth: true, allowedRoles: ["user"] },
    // },
    // {
    //     path: "/trainer/dashboard",
    //     component: TrainerDashboard,
    //     meta: { requiresAuth: true, allowedRoles: ["trainer"] },
    // },
    // {
    //     path: "/clerk/dashboard",
    //     component: ClerkDashboard,
    //     meta: { requiresAuth: true, allowedRoles: ["clerk"] },
    // },
    // {
    //     path: "/admin/dashboard",
    //     component: AdminDashboard,
    //     meta: { requiresAuth: true, allowedRoles: ["admin"] },
    // },
    {
        path: "/:pathMatch(.*)*",
        redirect: "/login",
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const authStore = useAuthStore();

    if (to.meta.requiresAuth && !authStore.isAuthenticated) {
        next("/login");
    } else if (
        to.meta.allowedRoles &&
        !to.meta.allowedRoles.includes(authStore.user.role)
    ) {
        next("/unauthorized");
    } else {
        next();
    }
});

export default router;
