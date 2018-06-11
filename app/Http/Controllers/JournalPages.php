<?php

namespace App\Http\Controllers;
use App\JournalPage;
use Request;
use URL;
use DB;

class JournalPages extends Controller {

   public function getPage($name) {
      $journalPage = JournalPage::where('name', $name)
         ->first();

      return response()->json($journalPage);
   }

}
