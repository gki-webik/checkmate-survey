import{_ as y,v as u,x as t,B as a,y as s,O as m,P as h,t as i}from"./DK77-Agx.js";const f={data(){return{answers:[],totalCount:"",noCount:"",yesCount:""}},mounted(){this.fetch()},methods:{async fetch(){try{const r=await fetch("https://gki-info.ru/api/list.php");if(!r.ok)throw new Error("Ошибка при загрузке данных");const n=await r.json();this.answers=n.answers,this.totalCount=n.totalCount,this.noCount=n.noCount,this.yesCount=n.yesCount}catch(r){console.error(r)}},exportToCSV(){const r=["ID","Имя","Телефон","Email","Дата","Ответы"],n=this.answers.map(l=>[l.id,l.name,l.telephone,l.email,l.date,...l.data.map(d=>d.answer)]);let p="data:text/csv;charset=utf-8,"+[r.join(","),...n.map(l=>l.join(";"))].join(`
`);const C=encodeURI(p),o=document.createElement("a");o.setAttribute("href",C),o.setAttribute("download","survey_data.csv"),document.body.appendChild(o),o.click(),document.body.removeChild(o)}}},k={class:"container"},b={class:"tbC"},v={key:0},x={class:"answer"},g={key:1};function w(r,n,p,C,o,l){return i(),u("div",null,[t("div",k,[n[7]||(n[7]=t("h1",null,"CheckMate",-1)),n[8]||(n[8]=t("h2",null,"Survey Website",-1)),t("button",{onClick:n[0]||(n[0]=(...e)=>l.exportToCSV&&l.exportToCSV(...e))},"Экспорт в CSV"),t("p",null,[n[1]||(n[1]=t("strong",null,"Всего заявок: ",-1)),a(" "+s(o.totalCount)+" ",1),n[2]||(n[2]=t("br",null,null,-1)),n[3]||(n[3]=t("strong",null,'Ответили "Да": ',-1)),a(" "+s(o.yesCount)+" ",1),n[4]||(n[4]=t("br",null,null,-1)),n[5]||(n[5]=t("strong",null,'Ответили "Нет": ',-1)),a(" "+s(o.noCount),1)]),t("div",b,[o.answers.length?(i(),u("table",v,[n[6]||(n[6]=t("thead",null,[t("tr",null,[t("th",null,"ID"),t("th",null,"Имя"),t("th",null,"Телефон"),t("th",null,"Email"),t("th",null,"Дата"),t("th",null,"Ответы")])],-1)),t("tbody",null,[(i(!0),u(m,null,h(o.answers,e=>(i(),u("tr",{key:e.id},[t("td",null,s(e.id),1),t("td",null,s(e.name),1),t("td",null,s(e.telephone),1),t("td",null,s(e.email),1),t("td",null,s(e.date),1),t("td",x,[t("ul",null,[(i(!0),u(m,null,h(e.data,(d,c)=>(i(),u("li",{key:c},s(d.answer),1))),128))])])]))),128))])])):(i(),u("p",g,"Загрузка данных..."))])])])}const V=y(f,[["render",w],["__scopeId","data-v-75a0c93c"]]);export{V as default};