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


import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'key',
    cluster: 'mt1',
    wsHost: window.location.hostname,
    wsPort: 6001,
    forceTLS: false,
    encrypted: false,
    disableStats: true,
    enabledTransports: ['ws', 'wss'],
});
