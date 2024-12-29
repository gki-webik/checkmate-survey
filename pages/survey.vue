<template>
  <div>
    <div class="container">
      <h1>CheckMate</h1>
      <h2>Survey Website</h2>
      <h4>О текущих методах контроля качества</h4>
      <p>Вопрос №{{ currentQuestion }} / 10</p>
      <div class="question">{{ questions[currentQuestion - 1].question }}</div>
      <label>
        <span>Напишите ответ на свой вопрос</span>
        <textarea v-model="questions[currentQuestion - 1].answer"></textarea>
      </label>
      <div class="btns">
        <button
          class="is-prev"
          @click="currentQuestion > 0 && currentQuestion--"
        >
          Назад
        </button>
        <button
          class="is-next"
          @click="
            currentQuestion < 10 && answer.trim() != ''
              ? currentQuestion++
              : null
          "
          :class="
            questions[currentQuestion - 1].answer.trim() != '' && 'is-active'
          "
        >
          Вперед
        </button>
      </div>
      <div class="progress">
        <div class="is-active" :style="{ width: progress + '%' }">
          {{ progress }}%
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
@import "@/public/assets/styles/dist/survey.css";
</style>
<script>
export default {
  data() {
    return {
      questions: [
        {
          question:
            "Как вы контролируете качество обслуживания в вашем заведении?",
          answer: "",
        },
        {
          question:
            "Используете ли вы сейчас тайных покупателей или другие методы проверки? Если да, что вам в них нравится или не нравится?",
          answer: "",
        },
        {
          question:
            "Как часто вы получаете обратную связь от гостей? Какими способами (опросы, отзывы онлайн)?",
          answer: "",
        },
        {
          question: "Какие основные проблемы в обслуживании вы замечали?",
          answer: "",
        },
        {
          question:
            "Как вы оцениваете влияние качества обслуживания на возвращаемость клиентов?",
          answer: "",
        },
        {
          question:
            "Были ли ситуации, когда плохое обслуживание привело к негативным отзывам или потере клиентов?",
          answer: "",
        },
        {
          question:
            "Есть ли у вас стандарты сервиса или чек-листы для персонала? Если да, как вы контролируете их выполнение?",
          answer: "",
        },
        {
          question:
            "Как вы проверяете, что сотрудники предлагают дополнительные услуги или товары?",
          answer: "",
        },
        {
          question:
            "Насколько важно для вас понимать, как каждый сотрудник взаимодействует с клиентами?",
          answer: "",
        },
        {
          question:
            "Готовы ли вы попробовать инструмент, который позволит получать объективные данные о работе персонала через тайных покупателей из числа ваших клиентов?",
          answer: "",
        },
      ],
      answer: "",
      currentQuestion: 1,
      progress: 30,
    };
  },
};
</script>