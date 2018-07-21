<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class JournalArticle extends Model {
   protected $table = 'journal_articles';
   protected $fillable = [
      'id',
      'title',
      'content',
      'description',
      'date',
      'category'
   ];
}
