import "./bootstrap";

import { createApp } from "vue";
import router from "./router";
import FormLogin from "./components/auth/Login.vue";

if (localStorage.getItem("token") == null) {
    const app = createApp(FormLogin);
    app.use(router).mount("#login");
} else {
    window.location.href = "/";
}
