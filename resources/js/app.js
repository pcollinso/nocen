
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueBootstrap from 'bootstrap-vue';
import VueNVD3 from 'vue-nvd3';
import VueInsProgressBar from 'vue-ins-progress-bar';
import VueEventCalendar from 'vue-event-calendar';
import VueSparkline from 'vue-sparklines';
import * as VueGoogleMaps from 'vue2-google-maps';
import Vueditor from '@agametov/vueditor';
import VueHljs from 'vue-hljs';
import VueSweetalert2 from 'vue-sweetalert2';
import VueNotification from 'vue-notification';
import VuePanel from './components/panel';
import VueDateTimePicker from 'vue-bootstrap-datetimepicker';
import VueSelect from 'vue-select';
import VueDatepicker from "vuejs-datepicker/dist/vuejs-datepicker.esm.js";
import VueMaskedInput from 'vue-maskedinput';
import VueInputTag from 'vue-input-tag';
import VueSlider from 'vue-slider-component';
import VueGoodTable from 'vue-good-table';
import VueFullCalendar from 'vue-full-calendar';
import VueCountdown from '@xkeshi/vue-countdown';
import VueColorpicker from 'vue-pop-colorpicker';
import VueMultiselect from 'vue-multiselect';

Vue.use(VueBootstrap);
Vue.use(VueNVD3);
Vue.use(VueEventCalendar, { locale: 'en' });
Vue.use(VueSparkline);
Vue.use(Vueditor);
Vue.use(VueHljs);
Vue.use(VueSweetalert2);
Vue.use(VueNotification);
Vue.use(VuePanel);
Vue.use(VueDateTimePicker);
Vue.use(VueGoodTable);
Vue.use(VueFullCalendar);
Vue.use(VueColorpicker);
Vue.use(VueGoogleMaps, {
  load: {
    key: '', // Add key
    libraries: 'places'
  }
});
Vue.use(VueInsProgressBar, {
  position: 'fixed',
  show: true,
  height: '3px'
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component('v-select', VueSelect);
Vue.component('datepicker', VueDatepicker)
Vue.component('masked-input', VueMaskedInput)
Vue.component('input-tag', VueInputTag)
Vue.component('vue-slider', VueSlider)
Vue.component(VueCountdown.name, VueCountdown);
Vue.component('vue-multiselect', VueMultiselect);


const files = require.context('./pages', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key)));


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

new Vue({
  el: '#app'
});
