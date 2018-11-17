<template>
   <div>
      <a class="studio-request__finishButton" v-on:click="finishRequest()">Закрыть заявку</a>
   </div>
</template>
<script>
   import axios from 'axios';
   axios.defaults.headers.post['Content-Type'] = 'multipart/form-data';
   export default {
      beforeMount() {
         this.id = this.$attrs.id;
         this.countFinishedRequests = this.$attrs.countFinishedRequests;
      },
      methods: {
         finishRequest() {
            var
               requestId = this.id,
               requestsTable = document.querySelector('#requestsTable'),
               finishedTable = document.querySelector('#finishedTable'),
               emptyRow = finishedTable.querySelector('.emptyRow'),
               row = document.querySelector('#line_' + requestId);
            row.deleteCell(6);
            row.remove();

            // Удалим строку «Нет заявок»
            if (emptyRow && emptyRow.classList.length === 1) {
               emptyRow.classList.add('hidden');
            }

            // Отобразим строку «Нет необработанных заявок»
            if (requestsTable.rows.length === 2) {
               var hiddenRow = requestsTable.querySelector('.hidden');
               hiddenRow.classList = '';
            }
            finishedTable.append(row);

            axios.put(
               window.location.origin + '/api/finish_request_to_studio', {
                  'id': requestId
               }
            ).catch((error) => {
               console.error(error);
            });
         }
      }
   }
</script>
<style>
   .studio-request__finishButton {
      color: gray;
      cursor: pointer;
      text-decoration: underline;
   }
   .studio-request__finishButton:hover {
      color: black;
   }
</style>
