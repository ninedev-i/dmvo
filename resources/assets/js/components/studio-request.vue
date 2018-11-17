<template>
   <div>
      <div class="requestButton button" data-fancybox data-src="#hiddenForm">
         Записаться в студию
      </div>

      <div style="display: none;" id="hiddenForm">
         <div class="requestTitle">Запись в студию</div>
         <form class="requestForm" method="POST" v-show="displayForm">
            <div class="requestLine">
               <label for="name">Имя и фамилия</label>
               <input type="text" id="name" value="">
            </div>
            <div class="requestLine">
               <label for="birthday">Дата рождения</label>
               <input type="date" id="birthday" value="">
            </div>
            <div class="requestLine">
               <label for="phone">Мобильный телефон</label>
               <input type="text" id="phone" value="">
            </div>
            <div class="smallbutton" v-on:click="sendRequest()">Записаться</div>
         </form>
      </div>
   </div>
</template>
<script>
   import axios from 'axios';
   axios.defaults.headers.post['Content-Type'] = 'multipart/form-data';
   export default {
      data: () => ({
         displayForm: true
      }),
      methods: {
         sendRequest() {
            var
               form = document.querySelector('.requestForm'),
               name = form.querySelector('#name').value,
               birthday = form.querySelector('#birthday').value,
               phone = form.querySelector('#phone').value,
               studio = window.location.pathname.split('/')[2],
               formData = new FormData();

            formData.append('name', name);
            formData.append('birthday', birthday);
            formData.append('phone', phone);
            formData.append('studio', studio);

            axios.post(
               window.location.origin + '/api/send_request_to_studio', formData
            ).then((response) => {
               this.displayForm = false;
               document.querySelector('.requestTitle').innerText = 'Ваша заявка отправлена';
            }).catch((error) => {
               console.error(error);
            });
         }
      }
   }
</script>
<style>
   .requestButton {
      width: 100%;
      padding: 10px 0px;
      font-size: 15px;
   }
   .requestTitle {
      font-weight: bold;
      font-size: 20px;
      color: #384047;
      margin-bottom: 15px;
   }
   .requestLine {
      display: flex;
   }
   .requestLine input {
      flex-grow: 1;
   }
   .requestLine label {
      width: 165px;
      line-height: 34px;
   }
</style>
