<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\View;
use App\Http\Requests;
use App\Attachment;
use App\People;
use App\Studio;
use App\Event;
use App\Media;
use App\User;
use App\Page;
use Request;
use Input;
use File;
use Auth;
use DB;

class Admin extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
      if (Auth::check() && in_array(Auth::user()->id, [1, 57, 63, 90])) {
      $title = 'Админка';

      return View::make('admin/index')
        ->with('title', $title);
     }
    }

    public function deletePhoto($id, $name) {
      File::delete(public_path().'/img/events/id'.$id.'/'.$name);
      return $id.$name;
   }
   public function deleteStudioPhoto($shortname, $name) {
      File::delete(public_path().'/img/studio/'.$shortname.'/'.$name);
      return $id.$name;
   }

   // Редактировать студии – список
  public function EditStudios() {
     $title = 'Список всех студий';
     $list = DB::table('studio')
        ->orderBy('studio_name', 'asc')
        ->get();

     return View::make('admin/liststudio')
        ->with('list', $list)
        ->with('title', $title);
   }

   public function getEditCurrentStudio($shortname) {
      $title = 'Редактировать студию';
      $content = Studio::where('shortname', $shortname)
         ->first();
      $peoplelist = User::where('show_or_not', '=', 'true')
         ->where('role', 'like', '%teacher%')
         ->orderBy('name', 'asc')
         ->get();
      $photos = Storage::disk('images')->allFiles('/studio/'.$shortname);

      return View::make('admin/studioedit')
         ->with('content', $content)
         ->with('photos', $photos)
         ->with('peoplelist', $peoplelist)
         ->with('title', $title);
   }

    public function postEditCurrentStudio($shortname, Request $request) {

      $input = Request::all();

      if ($input['direction']) {$alldirections = implode (' ', $input['direction']);}

      if ($input['teacher']) {$allteachers = implode (', ', $input['teacher']);}

      DB::table('studio')
            ->where('shortname', $shortname)
            ->update([
                      'studio_name' => $input['studio_name'],
                      'age_min' => $input['age_min'],
                      'age_max' => $input['age_max'],
                      'show_or_not' => $input['show_or_not'],
                      'price' => $input['price'],
                      'shortname' => $input['shortname'],
                      'phone' => $input['phone'],
                      'timetable' => $input['timetable'],
                      'room' => $input['room'],
                      'link' => $input['link'],
                      'content' => $input['content'],
                      'achievements' => $input['achievements'],
                      'show_requests' => $input['show_requests'],
                      'teacher' => $allteachers,
                      'direction' => $alldirections
                    ]);
      $photos = Input::file('upload_photos');
      if ($photos[0]) {
         $directory = public_path().'/img/studio/'.$shortname;
         if (!is_dir($directory)) {
            File::makeDirectory($directory);}
         foreach($photos as $photo) {
            $photoname = $photo->getClientOriginalName();
            Image::make($photo)->resize(1280, null, function ($constraint) { $constraint->aspectRatio(); })->save($directory.'/'.$photoname, 70);
         }
      }

      if ($input['show_or_not'] == 1) {
         return redirect('http://доммолодежи.рф/studio');
      } else {
         return redirect()->route('studio', ['shortname' => $shortname]);
      }
    }

    public function getAddStudio() {
      $title = 'Добавить студию';
      $studiolist = Studio::where('show_or_not', '=', '0')
         ->orderBy('studio_name', 'asc')
         ->get();
      $peoplelist = User::where('show_or_not', '=', 'true')
         ->where('role', 'like', 'teacher')
         ->orderBy('name', 'asc')
         ->get();

      return View::make('admin/studioadd')
         ->with('studiolist', $studiolist)
         ->with('peoplelist', $peoplelist)
         ->with('title', $title);
    }

    public function postAddStudio(Request $request) {

      $input = Request::all();

      if ($input['direction']) {$alldirections = implode (' ', $input['direction']);}

      if ($input['teacher']) {$allteachers = implode (', ', $input['teacher']);}

      Studio::insert(array(
                     'studio_name' => $input['studio_name'],
                     'age_min' => $input['age_min'],
                     'age_max' => $input['age_max'],
                     'price' => $input['price'],
                     'shortname' => $input['shortname'],
                     'teacher' => $allteachers,
                     'phone' => $input['phone'],
                     'timetable' => $input['timetable'],
                     'room' => $input['room'],
                     'link' => $input['link'],
                     'content' => $input['content'],
                     'achievements' => $input['achievements'],
                     'show_requests' => $input['show_requests'],
                     'show_or_not' => 0,
                     'direction' => $alldirections
                   ));

      $newShortname = $input['shortname'];
      $photos = Input::file('upload_photos');
      if ($photos[0]) {
         $directory = public_path().'/img/studio/'.$newShortname;
         if (!is_dir($directory)) {
            File::makeDirectory($directory);}
         foreach($photos as $photo) {
            $photoname = $photo->getClientOriginalName();
            Image::make($photo)->resize(1280, null, function ($constraint) { $constraint->aspectRatio(); })->save($directory.'/'.$photoname, 70);
         }
      }

      return redirect()->route('studio', ['shortname' => $newShortname]);
    }

    // Редактировать мероприятия – список
   public function EditEvents() {
      $title = 'Редактировать мероприятия';
      $list = DB::table('events')
         ->orderBy('date_from', 'desc')
         ->get();

      return View::make('admin/list')
         ->with('list', $list)
         ->with('title', $title);
    }

    public function getAddEvent() {
      $title = 'Добавить мероприятие';
      $studiolist = Studio::where('show_or_not', '=', '0')
         ->orderBy('studio_name', 'asc')
         ->get();
      $lastId = Event::all()->last()->id;

      return View::make('admin/eventadd')
      ->with('studiolist', $studiolist)
         ->with('futureId', ($lastId + 1))
         ->with('title', $title);
    }

    public function postAddEvent(Request $request) {

      $input = Request::all();

      if ($input['date_to'] == NULL) {$date_to = $input['date_from'];} else {$date_to = $input['date_to'];}
      if (!isset($input['tags'])) {$alltags = '';} else {$alltags = implode (' ', $input['tags']);}

      Event::insert(array(
                      'title' => $input['title'],
                      'content' => $input['content'],
                      'post_reliz' => $input['post_reliz'],
                      'right_column' => $input['right_column'],
                      'what_time' => $input['what_time'],
                      'date_from' => $input['date_from'],
                      'date_to' => $date_to,
                      'show_or_not' => 0,
                      'tags' => $alltags
                   ));

      $lastId = Event::all()->last()->id;
      $cover = Input::file('uploadFile');
      if ($cover) {
         Image::make($cover)->resize(1280, null, function ($constraint) { $constraint->aspectRatio(); })->save(public_path().'/img/events/covers/event_id'.$lastId.'.jpg', 70);
      }
      $photos = Input::file('upload_photos');
      if ($photos[0]) {
         $directory = public_path().'/img/events/id'.$lastId;
         if (!is_dir($directory)) {
            File::makeDirectory($directory);}
         foreach($photos as $photo) {
            $photoname = $photo->getClientOriginalName();
            Image::make($photo)->resize(1280, null, function ($constraint) { $constraint->aspectRatio(); })->save($directory.'/'.$photoname, 70);
         }
      }

      return redirect()->route('events', ['id' => $lastId]);

    }

   // Редактировать мероприятие – текущая страница
   public function getEditCurrentEvent($id) {
      $title = 'Редактировать страницу';
      $content = Event::where('id', $id)
         ->first();
      $studiolist = Studio::where('show_or_not', '=', '0')
         ->orderBy('studio_name', 'asc')
         ->get();
      $photos = Storage::disk('images')->allFiles('/events/id'.$id);
      $attachments = Attachment::where('event_id', '=', $id)
         ->get();

      return View::make('admin/eventedit')
         ->with('studiolist', $studiolist)
         ->with('content', $content)
         ->with('attachments', $attachments)
         ->with('photos', $photos)
         ->with('title', $title);
   }

    public function postEditCurrentEvent($id, Request $request) {

      $input = Request::all();

      if ($input['date_to'] == NULL) {$date_to = $input['date_from'];} else {$date_to = $input['date_to'];}
      if (!isset($input['tags'])) {$alltags = '';} else {$alltags = implode (' ', $input['tags']);}
      DB::table('events')
            ->where('id', $id)
            ->update([
                      'title' => $input['title'],
                      'content' => $input['content'],
                      'post_reliz' => $input['post_reliz'],
                      'show_or_not' => 0,
                      'right_column' => $input['right_column'],
                      'what_time' => $input['what_time'],
                      'date_from' => $input['date_from'],
                      'date_to' => $date_to,
                      'tags' => $alltags
                    ]);

      $cover = Input::file('uploadFile');
      if ($cover) {
         Image::make($cover)->resize(1280, null, function ($constraint) { $constraint->aspectRatio(); })->save(public_path().'/img/events/covers/event_id'.$id.'.jpg', 70);
      }
      $photos = Input::file('upload_photos');
      if ($photos[0]) {
         $directory = public_path().'/img/events/id'.$id;
         if (!is_dir($directory)) {
            File::makeDirectory($directory);}
         foreach($photos as $photo) {
            $photoname = $photo->getClientOriginalName();
            Image::make($photo)->resize(1280, null, function ($constraint) { $constraint->aspectRatio(); })->save($directory.'/'.$photoname, 70);
         }
      }

      return redirect()->route('events', ['id' => $id]);
    }

    // Удаление мероприятия
    public function deleteCurrentEvent($id) {
      DB::table('events')
         ->where('id', $id)
         ->update(['show_or_not' => 1]);

       return redirect('http://доммолодежи.рф/events');
    }

     // Редактировать страницы – список
     public function editPage() {
       $title = 'Редактировать страницы';
       $list = DB::table('pages')
         ->get();

       return View::make('admin/list')
         ->with('list', $list)
         ->with('title', $title);
     }

    // Редактировать страницы – текущая страница
    public function getEditCurrentPage($id) {
      $title = 'Редактировать страницу';

      $content = DB::table('pages')
        ->where('id', $id)
        ->first();

      return View::make('admin/pageedit')
        ->with('content', $content)
        ->with('title', $title);
    }

    public function postEditCurrentPage($id, Request $request) {

      $input = Request::all();
      // Настройка визуального редактора
      // $message=$input['content'];
      // $message = mb_convert_encoding($message, 'HTML-ENTITIES', "UTF-8");
      // $dom = new \DomDocument();
      // $dom->loadHtml($message, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
      // $images = $dom->getElementsByTagName('img');
      // foreach($images as $img){
      //     $src = $img->getAttribute('src');
      //
      //     if(preg_match('/data:image/', $src)){
      //         preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
      //         $mimetype = $groups['mime'];
      //         $filename = uniqid();
      //         // $filepath = "/summernoteimages/$filename.$mimetype";
      //         $filepath = "img/postimages/".$filename.'.'.$mimetype;
      //         $image = Image::make($src)
      //           /* ->resize(300, 200) */
      //           ->encode($mimetype, 100)  // encode file to the specified mimetype
      //           ->save(public_path($filepath));
      //         // $new_src = asset($filepath);
      //         $img->removeAttribute('src');
      //         $img->setAttribute('src', 'public/'.$filepath);
      //     }
      // }
      // $product = $dom->saveHTML();

      DB::table('pages')
            ->where('id', $id)
            ->update([
                      'title' => $input['title'],
                      'content' => $input['content'], /* для визуального редактора – $product */
                      'current_url' => $input['current_url'],
                    ]);

      return redirect($input['current_url']);
    }


    // Добавить СМИ
    public function getAddMassMedia() {
      $title = 'Добавить событие в раздел «СМИ о нас»';
      return View::make('admin/massmediaeventadd')
         ->with('title', $title);
   }

   public function postAddMassMedia(Request $request) {

     $input = Request::all();
     if ($input['date'] == NULL) {$date = date('Y-m-d');} else {$date = $input['date'];}

     Media::insert(array(
                     'date' => $date,
                     'owner' => $input['owner'],
                     'title' => $input['title'],
                     'content' => $input['content'],
                     'link' => $input['link'],
                     'show_or_not' => 'true'
                  ));

      $lastId = Media::all()->last()->id;
      return redirect()->route('massmedia', ['id' => $lastId]);

   }

   // Редактировать СМИ о нас
    public function getEditMassMedia($id) {
       $title = 'Редактировать страницу';

       $content = Media::where('id', $id)
        ->first();

       return View::make('admin/massmediaeventedit')
        ->with('content', $content)
        ->with('title', $title);
    }

    public function postEditMassMedia($id, Request $request) {

      $input = Request::all();
      if ($input['date'] == NULL) {$date = date('Y-m-d');} else {$date = $input['date'];}
      DB::table('media')
            ->where('id', $id)
            ->update([
                      'date' => $date,
                      'owner' => $input['owner'],
                      'title' => $input['title'],
                      'content' => $input['content'],
                      'link' => $input['link'],
                      'show_or_not' => $input['show_or_not']
                    ]);

      return redirect()->route('massmedia', ['id' => $id]);
    }




    // Выйти с сайта
    public function getLogout() {
      Auth::logout();
      return redirect('/');
    }

}
