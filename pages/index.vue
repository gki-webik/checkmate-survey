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
          <input type="text" />
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
        <button type="submit">Перейти к опросу</button>
      </form>
    </div>
  </div>
</template>
<style scoped>
@import "@/public/assets/styles/dist/index.css";
</style>
<script>
export default {};
</script>