
import "./bootstrap";

import { createApp } from "vue";
import router from "./router";
import FormLogin from "./components/auth/Login.vue";




const app = createApp(FormLogin);
// app.component('form-login',FormLogin);
app.use(router).mount("#login");
