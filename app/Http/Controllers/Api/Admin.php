<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Meta;

class Admin extends Controller {

   public function auth(Request $request) {
      return 'true';
   }

   public function failAuth(Request $request) {
      return 'false';
   }

   public function edit_contacts(Request $request) {
      return Meta::where('id', 4)
         ->update(['data' => $request['data']]);
   }
}
