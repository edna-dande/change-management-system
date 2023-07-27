import './bootstrap';
import '../sass/app.scss';

import 'bootstrap/dist/js/bootstrap.bundle.min';
import '@popperjs/core'

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { createApp } from "vue/dist/vue.esm-bundler";

import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { far } from '@fortawesome/free-regular-svg-icons'
import { fab } from '@fortawesome/free-brands-svg-icons'


library.add(fab, far, fas)

const app = createApp({});

app.component("admin-dashboard",import("./components/AdminDashboard.vue"));
app.component('font-awesome-icon', FontAwesomeIcon);


app.mount("#app");
