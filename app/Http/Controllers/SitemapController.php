<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SitemapController extends Controller {

public function index() {
   $page = Page::active()->orderBy('id', 'desc')->first();

   return response()->view('sitemap.index', [
   'page' => $page,
   ])->header('Content-Type', 'text/xml');
}

}
