// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  plugins: ["~/plugins/vue-the-mask.js"],
  compatibilityDate: "2024-11-01",
  ssr: false,
  devtools: { enabled: false },
});
