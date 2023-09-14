import "./bootstrap";

import { createApp } from "vue";
import router from "./router";
import App from "./components/App.vue";

if (localStorage.getItem("token") != null) {
    const app = createApp(App);
    app.use(router).mount("#app");
} else {
    window.location.href = "/login";
}
