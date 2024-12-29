// plugins/vue-the-mask.js
import { defineNuxtPlugin } from '#app';
import VueTheMask from 'vue-the-mask';

export default defineNuxtPlugin((nuxtApp) => {
  nuxtApp.vueApp.use(VueTheMask);
});