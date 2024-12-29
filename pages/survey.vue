<template>
  <div class="box">
    <div class="container">
      <div class="div">
        <h1>CheckMate</h1>
        <h2>Survey Website</h2>
        <div v-if="currentQuestion !== 100">
          <h4 v-if="currentQuestion <= 3">
            О текущих методах контроля качества
          </h4>
          <h4 v-if="currentQuestion >= 4 && currentQuestion <= 6">
            О проблемах в сервисе и их влиянии на бизнес
          </h4>
          <h4 v-if="currentQuestion >= 7 && currentQuestion <= 8">
            О стандартах и регламентах
          </h4>
          <h4 v-if="currentQuestion >= 9 && currentQuestion <= 10">
            О потребности в решении
          </h4>
          <!-- <p>Вопрос №{{ currentQuestion }} / 10</p> -->
          <div class="question" v-if="currentQuestion != 12">
            {{ questions[currentQuestion - 1].question }}
          </div>
          <label v-if="currentQuestion <= 10">
            <span>Напишите ответ на свой вопрос</span>
            <textarea
              v-model="questions[currentQuestion - 1].answer"
            ></textarea>
          </label>
          <label v-if="currentQuestion == 12">
            <span>Напишите свой Email</span>
            <input type="email" v-model="email" />
            <div class="error" v-if="error">{{ error }}</div>
          </label>
          <img
            src="/assets/media/1.png"
            v-if="currentQuestion == 11"
            alt="img"
          />
          <div class="btns">
            <button class="is-prev" @click="prevStep">Назад</button>
            <button
              class="is-next"
              @click="nextStep"
              v-if="currentQuestion <= 10"
              :class="
                questions[currentQuestion - 1].answer.trim() != '' &&
                'is-active'
              "
            >
              Вперед
            </button>
            <button
              class="is-final"
              @click="nextFinal('no')"
              v-if="currentQuestion == 11"
            >
              Нет
            </button>
            <button
              class="is-final"
              @click="nextFinal('yes')"
              v-if="currentQuestion == 11"
            >
              Да
            </button>
            <button
              class="is-final"
              @click="nextFinal('yesTrue')"
              v-if="currentQuestion == 12"
            >
              Вступить в лист ожидания
            </button>
          </div>
        </div>
        <div class="success" v-if="currentQuestion === 100">
          <p>Спасибо за участие в опросе!</p>
        </div>
      </div>
      <div class="progress" v-if="currentQuestion !== 100">
        <div class="is-active" :style="{ width: progress + '%' }">
          {{ progress }}%
        </div>
      </div>
    </div>
    <div class="figures">
      <div class="circle is-1"></div>
      <div class="circle is-2"></div>
      <div class="circle is-3"></div>
      <div class="square is-1"></div>
      <div class="square is-2"></div>
      <div class="square is-3"></div>
      <div class="square is-4"></div>
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
      error: null,
      email: "",
      telephone:
        typeof window !== "undefined" &&
        window.localStorage &&
        localStorage.getItem("currentTelephone"),
      name:
        typeof window !== "undefined" &&
        window.localStorage &&
        localStorage.getItem("currentName"),
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
        {
          question: "Вас интересует внедрение CheckMate?",
          answer: "",
        },
      ],
      answer: "",
      currentQuestion: 100,
      progress: 0,
    };
  },
  methods: {
    prevStep() {
      if (this.currentQuestion > 1) {
        this.currentQuestion--;
        this.progress -= 10;
      }
    },
    nextStep() {
      if (
        this.currentQuestion < this.questions.length &&
        this.questions[this.currentQuestion - 1].answer.trim() != ""
      ) {
        this.currentQuestion++;
        this.progress += 10;
      }
    },
    nextFinal(e) {
      if (e == "no" || e == "yesTrue") {
        console.log("de");
        if (e == "yesTrue") {
          const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
          if (!emailPattern.test(this.email)) {
            this.error = "Введен неправильный Email";
            return;
          }
        }
        this.questions[this.currentQuestion - 2].answer =
          e == "no" ? "Нет" : "Да";
        fetch("/api/send.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            name: this.name,
            telephone: this.telephone,
            email: this.email === "" ? "Не указано" : this.email,
            questions: this.questions,
          }),
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.success) {
              alert("Спасибо за ваш ответ. Ваша заявка отправлена.");
            } else {
              alert("Ошибка при отправке данных.");
            }
          })
          .catch((error) => {
            console.error("Error:", error);
            alert("Ошибка при отправке данных.");
          });
        console.log("dee");
      } else if (e == "yes") {
        this.currentQuestion++;
      }
    },
  },
};
</script>