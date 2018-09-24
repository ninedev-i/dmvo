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

   public function get_last_articles($current_cat, $current_id) {
      $categories = ['people', 'films', 'lifestyle', 'soul', 'hobby'];
      $list = [];

      foreach ($categories as $key => $cat) {
         $articles = JournalArticle::where('category', $cat)
            ->where('id', '!=', $current_id)
            ->orderByRaw('rand()')
            ->first(['id', 'title', 'category']);
         if ($articles !== null) {
            array_push($list, $articles);
         }
      }

      return $list;
   }

}
