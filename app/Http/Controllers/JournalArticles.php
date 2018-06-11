<?php

namespace App\Http\Controllers;
use App\JournalArticle;
use Request;
use URL;
use DB;

class JournalArticles extends Controller {

   public function getArticle($id) {
      $article = JournalArticle::where('id', $id)
         ->first();

      return response()->json($article);
   }

}
