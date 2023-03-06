import { createApp } from "vue";
import { createPinia } from "pinia";

import App from "./App.vue";
import router from "./router";

import "./assets/main.css";

import dayjs from 'dayjs'

const app = createApp(App);

app.provide('dayJS', dayjs)
app.use(createPinia());
app.use(router);

app.mount("#app");
