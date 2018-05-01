<?php

namespace App\Http\Controllers;
use App\Article;
use Request;
use URL;
use DB;

class Articles extends Controller {

   public function getArticle($id) {
      $article = Article::where('id', $id)
         ->first();

      return response()->json($article);
   }

}
