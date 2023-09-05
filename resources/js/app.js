import "./bootstrap";

import { createApp } from "vue";
import router from "./router";
import App from "./components/App.vue";
import Loader from "./components/Loader.vue";




const app = createApp(App);
app.component("Loader", Loader);

app.use(router).mount("#app");

