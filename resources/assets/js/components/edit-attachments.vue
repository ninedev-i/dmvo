<template>
   <div class="blockWithBorder">
      <edit-attachments-list ref="attachments_list" :eventId="eventId"></edit-attachments-list>
      <form class="attachment_form form_add" name="attachment_form" action="index.html" method="post">
         <select class="attachment_selector attachment_selectorType" name="type" v-model="selector">
            <option value="link">Ссылка</option>
            <option value="file">Файл</option>
         </select>
          <input v-if="selector == 'link'" type="text" name="link" placeholder="Ссылка" class="attachment_input">
         <input v-if="selector == 'file'" type="file" name="file_link" placeholder="Заголовок" class="attachment_file">
          <input type="text" name="title" placeholder="Заголовок" class="attachment_title" required />
          <select class="attachment_selector attachment_isButton" name="is_button">
            <option value="true">Кнопка</option>
            <option value="false">Ссылка</option>
         </select>
          <input type="hidden" name="_token" :value="csrf">
          <div v-on:click="add()" name="submit" class="smallbutton add_button">Добавить</div>
      </form>
   </div>
</template>
 <script>
   import axios from 'axios';
    axios.defaults.headers.post['Content-Type'] = 'multipart/form-data';
    export default {
      data: () => ({
         csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
         selector: 'file'
      }),
      beforeMount() {
         this.eventId = this.$attrs.eventid;
         this.siteUrl = window.location.origin;
      },
       methods: {
         add() {
            var
               form = document.querySelector('.form_add'),
               type = form.querySelector('.attachment_selectorType').value,
               title = form.querySelector('.attachment_title').value,
               path = type == 'file' ? form.querySelector('.attachment_file').files[0] : form.querySelector('.attachment_input').value,
               isButton = form.querySelector('.attachment_isButton').value,
               formData = new FormData();
             if (!title || !path) {
               alert('Не все поля заполнены')
               return;
            }
             formData.append('event_id', this.eventId);
            formData.append('type', type);
            formData.append('path', path);
            formData.append('title', title);
            formData.append('is_button', isButton);
            formData.append('exists', 'true');
             axios.post(
               this.siteUrl + '/admin/add_attachement', formData
            ).then((response) => {
               this.$refs.attachments_list.getList();
               form.reset();
               this.selector = 'link';
            }).catch((error) => {
               console.error(error);
            });
         }
      }
   }
</script>
 <style>
   .blockWithBorder {
      margin-bottom: 10px;
      padding-bottom: 10px;
   }
   .attachment_form {
      display: flex;
      flex-direction: row;
      justify-content: center;
      align-items: baseline;
   }
   .attachment_input,
   .attachment_title {
      display: inline-block !important;
      width: 300px;
   }
   .attachment_input {
      margin-left: 10px;
   }
   .attachment_selector {
      display: inline-block !important;
      font-size: 16px;
      padding: 6px !important;
      margin-bottom: 10px;
      border-color: #006699;
   }
   .attachment_file {
      margin-left: 12px;
      width: 310px;
   }
   .attachment_form input,
   .attachment_form select {
      margin-left: 0px;
      margin-right: 12px;
   }
   .attachment_form input[type='file'] {
      padding-top: 0px !important;
   }
   .attachment_form .add_button {
      margin-right: 0px;
   }
</style>
