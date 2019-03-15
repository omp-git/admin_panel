<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ajaxController extends Controller
{
//    remove file from upload path when deleted in database
    public function deleteFile()
    {
        $Model = '\\' . request()->model; // get model name
        $record = null;
        if ($record = $Model::findOrFail($id)) {
            $field = request()->field; // get file(image) type field
            $items = json_decode($record->$field); // array from json
            if (is_array($items)) {
                foreach ($items as $index => $item) {
                    if ($index == 'download_link' || $index == 'original_name') // looking for "file" content
                    {
                        $record->$field = null;
                    }
                }

            } else {
                $record->$field = null;
            }
            $record->save();

        }
        if (\Storage::disk(config('voyager.storage.disk'))->exists(request()->file_path)) {
            \Storage::disk(config('voyager.storage.disk'))->delete(request()->file_path);
            //delete file from storage
        }
        return response()->json(['status' => true, 'message' => $record], 201);
    }
}
