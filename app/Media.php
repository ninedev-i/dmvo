<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model {

   protected $table = 'media';

   public function shortDescription() {
      $text = $this->content;
      return str_replace(array("<p>", "</p>", "<br />", "<b>", "</b>", "<i>", "</i>") , ' ', strip_tags( implode( ' ', array_slice( explode( ' ', $text ), 0, 31 ) ).'...' ) );
   }

}
