import "./bootstrap";

import { createApp } from "vue";
import App from "./components/App.vue";
import BlogList from "./components/BlogList.vue";
import BlogCreate from "./components/BlogCreate.vue";
import BlogEdit from "./components/BlogEdit.vue";

import { createRouter, createWebHistory } from "vue-router";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            name: "home",
            path: "/",
            component: BlogList,
        },
        {
            name: "create_blog",
            path: "/blog/create",
            component: BlogCreate,
        },
        {
            name: "edit_blog",
            path: "/blog/edit",
            component: BlogEdit,
        },
    ],
});

// export default router;


const app = createApp(App);

app.use(router).mount("#app");
