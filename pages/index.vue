<template>
  <div>
    <div class="circle is-1"></div>
    <div class="circle is-2"></div>
    <div class="square is-1"></div>
    <div class="square is-2"></div>
    <div class="square is-3"></div>
    <div class="container">
      <h1>CheckMate</h1>
      <h2>Survey Website</h2>
      <form>
        <label>
          <span>Название компании</span>
          <input type="text" v-model="name" />
        </label>
        <label>
          <span>Номер телефона</span>
          <input
            id="phone"
            v-mask="'+7 (###) ###-##-##'"
            v-model="phone"
            type="text"
            placeholder="+7 (___) ___-__-__"
          />
        </label>
        <button type="button" @click="sendData()">Перейти к опросу</button>
        <div class="error" v-if="error">{{ error }}</div>
      </form>
    </div>
  </div>
</template>
<style scoped>
@import "@/public/assets/styles/dist/index.css";
</style>
<script>
export default {
  data() {
    return {
      name: "",
      phone: "",
      error: null,
    };
  },
  methods: {
    sendData() {
      if (this.phone.trim() == "" || this.name.trim() == "") {
        this.error = "Пожалуйста, заполните все поля";
        return;
      }
      if (typeof window !== "undefined" && window.localStorage) {
        localStorage.setItem("currentName", this.name);
        localStorage.setItem("currentTelephone", this.phone);
        this.$router.push("/survey");
      }
    },
  },
};
</script>