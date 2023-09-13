import { createRouter, createWebHistory } from "vue-router";
import BlogList from "@/components/blogs/BlogList.vue";
import BlogCreate from "@/components/blogs/BlogCreate.vue";
import BlogEdit from "@/components/blogs/BlogEdit.vue";
import BlogSingle from "@/components/blogs/BlogSingle.vue";
import notFound from "@/components/notFound.vue";
import Home from "@/components/posts/Home.vue";
import Login from "@/components/auth/Login.vue";


const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            name: "home",
            path: "/",
            component: Home,
        },
        {
            name: "all_blog",
            path: "/blogs",
            component: BlogList,
        },
        {
            name: "create_blog",
            path: "/blog/create",
            component: BlogCreate,
        },
        {
            name: "edit_blog",
            path: "/blog/:id/edit",
            component: BlogEdit,
        },
        {
            name: "show_blog",
            path: "/blog/:id/show",
            component: BlogSingle,
        },
        {
            name : "notFound",
            path: "/:path(.*)",
            component: notFound,
        },
        {
            name : "login",
            path: "/login",
            component: Login,
        }
    ],
});
router.beforeEach((to, from, next) => {
    if (localStorage.getItem("token") != null) {
        next();
    } else {
        if (to.name === "login") {
            next();
        } else {
            // Redirect to login page with a page reload
            window.location.href = '/login';
        }
    }
});
export default router;
