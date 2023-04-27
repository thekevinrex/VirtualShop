import "./bootstrap";
import "../css/app.css";

import { createApp } from "vue/dist/vue.esm-bundler.js";
import pinia from "./store/store";
import App from './page/app.vue';

const el = document.getElementById("app");

const app = createApp(App)
    .use(pinia);

Object.entries(import.meta.globEager('./components/*.vue')).forEach(([path, definition]) => {
    app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
});

app.mount(el);
