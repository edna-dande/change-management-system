// import 'jquery-ui/ui/widgets/datepicker.js';
import './bootstrap';

import { createApp } from "vue";


import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { far } from '@fortawesome/free-regular-svg-icons'
import { fab } from '@fortawesome/free-brands-svg-icons'

library.add(fab, far, fas)

const app = createApp({});
app.component("admin-dashboard", require("./components/AdminDashboard.vue").default);





app.component('font-awesome-icon', FontAwesomeIcon);


app.mount("#app");

