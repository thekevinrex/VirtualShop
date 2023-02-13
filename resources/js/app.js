import "./bootstrap";
import "../css/app.css";
import "@protonemedia/laravel-splade/dist/style.css";
import 'tw-elements';
import.meta.glob([
    '../images/**',
]);

import { createApp } from "vue/dist/vue.esm-bundler.js";
import { renderSpladeApp, SpladePlugin } from "@protonemedia/laravel-splade";
import pinia from "./store/store";

const el = document.getElementById("app");

const app   = createApp({
    render: renderSpladeApp({ el }),
    mounted() {
        console.log();
    }
})
.use(SpladePlugin, {
    "max_keep_alive": 10,
    "transform_anchors": false,
    "progress_bar": true
})
.use(pinia);

Object.entries(import.meta.globEager('./components/*.vue')).forEach(([path, definition]) => {
    app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
});

app.mount(el);
