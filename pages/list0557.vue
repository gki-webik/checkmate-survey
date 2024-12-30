<template>
  <div>
    <div class="container">
      <h1>CheckMate</h1>
      <h2>Survey Website</h2>
      <button @click="exportToCSV">Экспорт в CSV</button>
      <p>
        <strong>Всего заявок: </strong> {{ totalCount }} <br />
        <strong>Ответили "Да": </strong> {{ yesCount }} <br />
        <strong>Ответили "Нет": </strong> {{ noCount }}
      </p>
      <div class="tbC">
        <table v-if="answers.length">
          <thead>
            <tr>
              <th>ID</th>
              <th>Имя</th>
              <th>Телефон</th>
              <th>Email</th>
              <th>Дата</th>
              <th>Ответы</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="answer in answers" :key="answer.id">
              <td>{{ answer.id }}</td>
              <td>{{ answer.name }}</td>
              <td>{{ answer.telephone }}</td>
              <td>{{ answer.email }}</td>
              <td>{{ answer.date }}</td>
              <td class="answer">
                <ul>
                  <li v-for="(question, index) in answer.data" :key="index">
                    {{ question.answer }}
                  </li>
                </ul>
              </td>
            </tr>
          </tbody>
        </table>
        <p v-else>Загрузка данных...</p>
      </div>
    </div>
  </div>
</template>

<style scoped>
@import "@/public/assets/styles/dist/survey.css";
.container {
  justify-content: inherit;
  width: 100%;
}
h1 {
  font-size: clamp(2rem, 5.5vw, 3rem);
}
h2 {
  font-size: clamp(2.5rem, 5.5vw, 3.2rem);
}
button {
  margin: 10px 0;
  padding: 10px 20px;
  font-size: 16px;
  cursor: pointer;
}
table {
  width: 100%;
  border-collapse: collapse;
  margin: 20px 0;
  font-size: 18px;
  text-align: left;
}

th,
td {
  padding: 12px;
  border-bottom: 1px solid #ddd;
}

th {
  background-color: #f2f2f2;
}

tr:hover {
  background-color: #f5f5f5;
}

.answer {
  min-width: 400px;
}
@media screen and (max-width: 1100px) {
  .tbC {
    max-width: 900px;
    overflow: auto;
  }
}
</style>

<script>
export default {
  data() {
    return {
      answers: [],
      totalCount: "",
      noCount: "",
      yesCount: "",
    };
  },
  mounted() {
    this.fetch();
  },
  methods: {
    async fetch() {
      try {
        const response = await fetch("https://gki-info.ru/api/list.php");
        if (!response.ok) {
          throw new Error("Ошибка при загрузке данных");
        }
        const data = await response.json();
        this.answers = data.answers;
        this.totalCount = data.totalCount;
        this.noCount = data.noCount;
        this.yesCount = data.yesCount;
      } catch (error) {
        console.error(error);
      }
    },
    exportToCSV() {
      const headers = ["ID", "Имя", "Телефон", "Email", "Дата", "Ответы"];
      const rows = this.answers.map((answer) => {
        const row = [
          answer.id,
          answer.name,
          answer.telephone,
          answer.email,
          answer.date,
          ...answer.data.map((q) => q.answer),
        ];
        return row;
      });

      let csvContent =
        "data:text/csv;charset=utf-8," +
        [headers.join(","), ...rows.map((e) => e.join(";"))].join("\n");

      const encodedUri = encodeURI(csvContent);
      const link = document.createElement("a");
      link.setAttribute("href", encodedUri);
      link.setAttribute("download", "survey_data.csv");
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
    },
  },
};
</script>