import { createServer } from "http";
import { createSSRApp } from "vue";
import { renderToString } from "@vue/server-renderer";
import { renderSpladeApp, SpladePlugin, startServer } from "@protonemedia/laravel-splade";
import pinia from "./store/store";

const server = startServer(createServer, renderToString, (props) => {
    return createSSRApp({
        render: renderSpladeApp(props)
    })
        .use(SpladePlugin)
        .use(pinia);
});

Object.entries(import.meta.globEager('./components/*.vue')).forEach(([path, definition]) => {
    server.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
});