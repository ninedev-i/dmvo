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

   public function getList($category) {
      $articles = JournalArticle::where('category', $category)
         ->where('show_article', 'true')
         ->orderBy('date', 'desc')
         ->get();

      return response()->json($articles);
   }

}
