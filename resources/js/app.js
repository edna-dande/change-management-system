import './bootstrap';
import '../sass/app.scss';

import 'bootstrap/dist/js/bootstrap.bundle.min';
import '@popperjs/core'

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// import { createApp } from "vue";
import { createApp } from "vue/dist/vue.esm-bundler";

import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { far } from '@fortawesome/free-regular-svg-icons'
import { fab } from '@fortawesome/free-brands-svg-icons'


library.add(fab, far, fas)

import AdminDashboard from "./components/AdminDashboard.vue";
import SystemDashboard from "./components/SystemDashboard.vue";
import RoleDashboard from "./components/RoleDashboard.vue";
import UserDetails from "./components/UserDetails.vue";
import SystemDetails from "./components/SystemDetails.vue";
import RoleDetails from "./components/RoleDetails.vue";

const app = createApp({});

app.component("admin-dashboard", AdminDashboard);
app.component("system-dashboard", SystemDashboard);
app.component("role-dashboard", RoleDashboard);
app.component("user-details", UserDetails);
app.component("system-details", SystemDetails);
app.component("role-details", RoleDetails);

app.component('font-awesome-icon', FontAwesomeIcon);


app.mount("#app");
