<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Attachment;
use Input;
use File;

class Attachments extends Controller {
    public function get($event_id) {
      $attachments = Attachment::where('event_id', '=', $event_id)
         ->get();
       return $attachments;
   }
    // Добавим вложение
   public function add(Request $request) {
      if ($request['type'] == 'link') {
         $path = $request['path'];
      } else {
         $directory = public_path().'/attachments/'.$request['event_id'];
         if (!is_dir($directory)) {
            File::makeDirectory($directory);
         }
         $new_file_name = str_slug($request['path']->getClientOriginalName(), '-').'.'.$request['path']->getClientOriginalExtension();
         $folder_and_file = '/'.$request['event_id'].'/'.$new_file_name;
         Storage::disk('attachments')->put($folder_and_file, file_get_contents($request->file('path')->getRealPath()));
         $path = $new_file_name;
      }
      Attachment::insert(array(
         'event_id' => $request['event_id'],
         'type' => $request['type'],
         'path' => $path,
         'title' => $request['title'],
         'is_button' => $request['is_button'],
         'exists' => $request['exists']
      ));
   }
    // Изменим вложение
   public function update(Request $request) {
      $attachment = Attachment::find($request['id']);
       $attachment->path = $request['path'];
      $attachment->title = $request['title'];
      $attachment->is_button = $request['is_button'];
       $attachment->save();
   }
    public function delete(Request $request) {
      if ($request['type'] == 'file') {
         Storage::disk('attachments')->delete($request['event_id'].'/'.$request['path']);
      }
      return Attachment::destroy($request['id']);
   }
}
