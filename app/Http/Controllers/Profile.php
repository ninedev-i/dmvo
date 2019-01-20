<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Timetable;
use Carbon\Carbon;
use App\User;
use Request;
use Input;
use Excel;
use File;
use Auth;
use DB;

class Profile extends Controller {

   public function index() {
      $userid = Auth::user()->id;
      $user = User::where('id', $userid)
         ->first();

      $timetable = Timetable::where('user_id', Auth::user()->id)
         ->orderBy('which_date', 'asc')
         ->get();

      $control = false;
      if (Auth::check() && Auth::user()->role == 'control') {
         $control = true;
      }

      return View::make('profile/index')
         ->with('timetable', $timetable)
         ->with('control', $control)
         ->with('user', $user);
   }

   public function edit() {
      $userid = Auth::user()->id;
      $user = User::where('id', $userid)
         ->first();

      return View::make('profile/edit')
         ->with('user', $user);
   }

   public function postEdit(Request $request) {
      $id = Auth::user()->id;
      $username = Auth::user()->username;
      $input = Request::all();

      DB::table('users')
         ->where('id', $id)
         ->update([
            'name' => $input['name'],
            'bio' => $input['bio']
         ]);

      $photo = Input::file('uploadFile');
      if ($photo) {
         Image::make($photo)->resize(1280, null, function ($constraint) { $constraint->aspectRatio(); })->save(public_path().'/img/users/'.$username.'.jpg', 70);
      }

     return redirect('https://доммолодежи.рф/profile');
   }

   public function postTimetable(Request $request) {
      $id = Auth::user()->id;
      $input = Request::all();

      if($input['timetable_deal'] == 'Иное' && $input['timetable_other'] != '') {$deal = $input['timetable_other'];}
      elseif ($input['timetable_deal'] == 'Иное' && $input['timetable_other'] == '') {$deal = 'Иное';}
      else {$deal = $input['timetable_deal'];}

      DB::table('timetable')->insert([
         'user_id' => $id,
         'which_date' => $input['timetable_date'],
         'how_much_time' => $input['timetable_time'],
         'what_was_doing' => $deal,
         'what_place' => $input['timetable_place'],
         'comment' => $input['timetable_comment']
      ]);

      return redirect('https://доммолодежи.рф/profile');
   }

   public function updateTimetable(Request $request) {
      $input = Request::all();

      if ($input['post_or_del'] == 'Изменить') {
         DB::table('timetable')
            ->where('id', $input['timetable_id'])
            ->update([
               'which_date' => $input['timetable_date'],
               'how_much_time' => $input['timetable_time'],
               'what_was_doing' => $input['timetable_other'],
               'what_place' => $input['timetable_place'],
               'comment' => $input['timetable_comment']
            ]);
      } elseif ($input['post_or_del'] == 'Удалить') {
         DB::table('timetable')
            ->where('id', $input['timetable_id'])
            ->delete();
      }

      return redirect('https://доммолодежи.рф/profile');
   }

   public function downloadExcel($type) {
      $data = User::join('timetable', 'timetable.user_id', '=', 'users.id')
         ->select('users.name', 'timetable.which_date', 'timetable.how_much_time', 'timetable.what_was_doing', 'timetable.what_place', 'timetable.comment')
         ->orderBy('timetable.which_date')
         ->get()->toArray();

		return Excel::create('Отчет по педагогам', function($excel) use ($data) {
			$excel->sheet('Отчет', function($sheet) use ($data) {
            $sheet->setFontFamily('Times New Roman');
            $sheet->setFontSize(12);
            $sheet->setAutoSize(true);

				$sheet->fromArray($data);
            $sheet->row(1, array( 'ФИО', 'Дата', 'Часов', 'Вид занятости', 'Место', 'Примечание' ));
            $sheet->row(1, function($row) {
               $row->setBackground('#F0F0F0');
               $row->setFontWeight('bold');
            });
         });
		})->download($type);
	}

   public function downloadExcelId($id) {
      $data = User::join('timetable', 'timetable.user_id', '=', 'users.id')
         ->select('users.name', 'timetable.which_date', 'timetable.how_much_time', 'timetable.what_was_doing', 'timetable.what_place', 'timetable.comment')
         ->where('timetable.user_id', $id)
         ->orderBy('timetable.which_date')
         ->get();
      // $months = Timetable::select('which_date')
      //    ->where('user_id', $id)
      //    ->groupBy(DB::raw("YEAR(which_date), MONTH(which_date)"))
      //    ->orderBy('which_date')
      //    ->get();

      return Excel::create('Отчет по педагогам', function($excel) use ($data) { // , $months
         // for ($i=0; $i < $months->count(); $i++) {
            $excel->sheet('Отчет', function($sheet) use ($data) {
               $sheet->setFontFamily('Times New Roman');
               $sheet->setFontSize(12);
               $sheet->setAutoSize(true);
               // $sheet->setWidth(array(
               //     'A' => 35,
               //     'B' => 10,
               //     'C' => 6,
               //     'D' => 35,
               //     'E' => 25,
               //     'F' => 65
               // ));
               $sheet->fromArray($data);
               $sheet->row(1, array( 'ФИО', 'Дата', 'Часов', 'Вид занятости', 'Место', 'Примечание' ));
               $sheet->row(1, function($row) {
                  $row->setBackground('#F0F0F0');
                  $row->setFontWeight('bold');
               });
            });
            // $excel->sheet(date('F Y', strtotime($months[$i]->which_date)), function($sheet) use ($data) {
            //    $sheet->setFontFamily('Times New Roman');
            //    $sheet->setFontSize(12);
            //    $sheet->setAutoSize(true);
            //    // $sheet->setWidth(array(
            //    //     'A' => 35,
            //    //     'B' => 10,
            //    //     'C' => 6,
            //    //     'D' => 35,
            //    //     'E' => 25,
            //    //     'F' => 65
            //    // ));
            //    $sheet->fromArray($data);
            //    $sheet->row(1, array( 'ФИО', 'Дата', 'Часов', 'Вид занятости', 'Место', 'Примечание' ));
            //    $sheet->row(1, function($row) {
            //       $row->setBackground('#F0F0F0');
            //       $row->setFontWeight('bold');
            //    });
            // });
         // }
      })->download('xls');
   }

}
