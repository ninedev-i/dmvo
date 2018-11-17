<template>
   <div>
      <div v-if="data && data.length > 0" v-for="attachment in data">
         <div v-if="attachment.exists == 'true' && attachment.type == 'link'">
            <a v-bind:href="attachment.path" v-bind:class="[attachment.is_button == 'true' ? 'smallbutton' : '']" target="_blank">{{attachment.title}}</a>
         </div>
         <div v-else-if="attachment.exists == 'true' && attachment.type == 'file'">
            <a v-bind:href="siteUrl + '/public/attachments/' + eventId + '/' + attachment.path" v-bind:class="[attachment.is_button == 'true' ? 'smallbutton' : '']" target="_blank">{{attachment.title}}</a>
         </div>
     </div>
   </div>
</template>
 <script>
   export default {
      beforeMount() {
         this.data = JSON.parse(this.$attrs.data);
         this.eventId = this.$attrs.eventid;
         this.siteUrl = window.location.origin;
      }
   }
</script>
