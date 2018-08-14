<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentsTable extends Migration {

   public function up() {
      Schema::create('attachments', function (Blueprint $table) {
         $table->increments('id');
         $table->integer('event_id');
         $table->string('path');
         $table->string('type');
         $table->string('title');
         $table->string('exists');
         $table->rememberToken();
         $table->timestamps();
      });
   }

   public function down() {
   //
   }
}
