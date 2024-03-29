<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class Authorization extends Controller {
   public $successStatus = 200;

   // Логин
   public function login(Request $request) {
      $data = [
         // 'username' => request('name'),
         'email' => request('email'),
         'password' => request('password')
      ];

      if (Auth::attempt($data, True)) {
         $user = Auth::user();
         $success['token'] = $user->createToken('MyApp')->accessToken;
//         return USER::where('id', $user['id'])
//                     ->first('remember_token');
         return response()->json(['success' => $success], $this->successStatus);
      } else {
         return 'НЕТ!';
         return response()->json(['error' => 'Unauthorised'], 401);
      }
   }

   // Регистрация
   public function register(Request $request) {
      $validator = Validator::make($request->all(), [
         'name' => 'required',
         'email' => 'required|email',
         'password' => 'required',
         'c_password' => 'required|same:password',
      ]);
      if ($validator->fails()) {
         return response()->json(['error' => $validator->errors()], 401);
      }
      $input = $request->all();
      $user = User::create($input);
      $success['token'] = $user->createToken('MyApp')-> accessToken;
      $success['name'] = $user->name;
      return response()->json(['success' => $success], $this->successStatus);
   }

   public function details() {
      $user = Auth::user();
      return response()->json(['success' => $user], $this->successStatus);
   }

   public function is_authorized() {
      $user = Auth::user();
      return $user;
   }
}