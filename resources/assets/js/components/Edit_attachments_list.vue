<template>
   <div>
      <div v-if="data && data.length > 0" v-for="attachment in data">
         <div class="edit_attachments_block">
            <form :class="'attachment_form form_' + attachment.id" name="attachment_form" id="upload_form" action="index.html" method="post">
                <input type="text" name="link" placeholder="Ссылка" class="attachment_input attachment_path" :value="attachment.path" :disabled="attachment.type == 'file'">
                <input type="text" name="title" placeholder="Заголовок" class="attachment_title" :value="attachment.title">
                <select class="attachment_selector attachment_isButton" name="is_button" v-model="attachment.is_button">
                  <option value="true">Кнопка</option>
                  <option value="false">Ссылка</option>
               </select>
                <input type="hidden" name="type" class="attachment_type" :value="attachment.type">
               <input type="hidden" name="_token" :value="csrf">
                <a v-on:click="deleteAttachment(attachment.id)" type="button" name="submit" class="smallbutton redbutton">Удалить</a>
               <a v-on:click="updateAttachment(attachment.id)" type="button" name="submit" class="smallbutton">Изменить</a>
            </form>
         </div>
     </div>
   </div>
</template>
 <script>
   import axios from 'axios';
    axios.defaults.headers.post['Content-Type'] = 'multipart/form-data';
    export default {
      beforeMount() {
         this.data = [];
         this.eventId = this.$attrs.eventId;
         this.siteUrl = window.location.origin;
          this.getList();
      },
       methods: {
         deleteAttachment(id) {
            var
               form = document.querySelector('.form_' + id),
               type = form.querySelector('.attachment_path').disabled === true ? 'file' : 'link',
               path = form.querySelector('.attachment_path').value,
               formData = new FormData();

            formData.append('event_id', this.eventId);
            formData.append('id', id);
            formData.append('type', type);
            formData.append('path', path);
             axios.post(
               this.siteUrl + '/admin/delete_attachement', formData
            ).then((response) => {
               this.getList();
            }).catch((error) => {
               console.error(error);
            });
         },
          updateAttachment(id) {
            var
               form = document.querySelector('.form_' + id),
               is_button = form.querySelector('.attachment_isButton').value,
               path = form.querySelector('.attachment_path').value,
               title = form.querySelector('.attachment_title').value,
               formData = new FormData();
             if (!title || !path) {
               alert('Не все поля заполнены')
               return;
            }
             formData.append('id', id);
            formData.append('is_button', is_button);
            formData.append('path', path);
            formData.append('title', title);
             axios.post(
               this.siteUrl + '/admin/update_attachement', formData
            ).then((response) => {
               this.getList();
            }).catch((error) => {
               console.error(error);
            });
         },
          getList() {
            axios.get(
               this.siteUrl + '/admin/get_attachements/' + this.eventId
            ).then((response) => {
               this.data = response.data;
               this.$forceUpdate();
            }).catch((error) => {
               console.error(error);
            });
         }
      }
   }
</script>
 <style>
   .edit_attachments_block {
      display: block;
   }
   .edit_attachments_block input,
   .edit_attachments_block select {
      margin-left: 0px;
      margin-right: 12px;
   }
   .edit_attachments_block a:last-child {
      margin-right: 0px;
   }
   .edit_attachments_block input[type='file'] {
      padding-left: 0px !important;
   }
</style>
