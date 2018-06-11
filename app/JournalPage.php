<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class JournalPage extends Model {
   protected $table = 'journal_pages';
   protected $fillable = [
      'id',
      'name',
      'title',
      'content'
   ];
}
