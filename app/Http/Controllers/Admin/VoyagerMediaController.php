<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\VoyagerMediaController as BaseVoyagerMediaController;

class VoyagerMediaController extends BaseVoyagerMediaController
{
    // override remove function for remove file(s) in upload path if image deleted in database
    public function remove(Request $request)
    {
        // Check permission
        $this->authorize('browse_media');

        try {
            // GET THE SLUG, ex. 'posts', 'pages', etc.
            $slug = $request->get('slug');

            // GET file name
            $filename = $request->get('filename');
            // GET record id
            $id = $request->get('id');

            // GET field name
            $field = $request->get('field');

            // GET multi value
            $multi = $request->get('multi');

            // GET THE DataType based on the slug
            $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

            // Check permission
            $this->authorize('delete', app($dataType->model_name));

            // Load model and find record
            $model = app($dataType->model_name);
            $data = $model::find([$id])->first();

            // Check if field exists
            if (!isset($data->{$field})) {
                throw new Exception(__('voyager::generic.field_does_not_exist'), 400);
            }

            if (@json_decode($multi)) {
                // Check if valid json
                if (is_null(@json_decode($data->{$field}))) {
                    throw new Exception(__('voyager::json.invalid'), 500);
                }

                // Decode field value
                $fieldData = @json_decode($data->{$field}, true);
                $key = null;

                // Check if we're dealing with a nested array for the case of multiple files
                if (is_array($fieldData[0])) {
                    foreach ($fieldData as $index=>$file) {
                        $file = array_flip($file);
                        if (array_key_exists($filename, $file)) {
                            $key = $index;
                            break;
                        }
                    }
                } else {
                    $key = array_search($filename, $fieldData);
                }

                // Check if file was found in array
                if (is_null($key) || $key === false) {
                    throw new Exception(__('voyager::media.file_does_not_exist'), 400);
                }

                // Remove file from array
                unset($fieldData[$key]);
                // Generate json and update field
                $data->{$field} = empty($fieldData) ? null : json_encode(array_values($fieldData));
            } else {
                $data->{$field} = null;
            }
            // update database field
            $data->save();

            // remove file(s) from upload path
            // get real storage path of file
            $storage_path = str_replace(['\\', '//'], '/',
                Storage::disk(config('voyager.storage.disk'))->path(substr($filename,0,strrpos($filename,'\\')) . '/'));

            $file_without_extension = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
            $raw_name = last(explode('\\', $file_without_extension));

            // get all files
            $files = array_filter(scandir($storage_path), function($el) use ($raw_name) {
                return strpos($el, $raw_name)!== false;
            }, ARRAY_FILTER_USE_BOTH);

            foreach ($files as $file) {
                $file = substr($filename,0,strrpos($filename,'\\')) . '/' . $file;
                if (Storage::disk(config('voyager.storage.disk'))->exists($file)) {
                    Storage::disk(config('voyager.storage.disk'))->delete($file);
                }
            }
            return response()->json([
                'data' => [
                    'status'  => 200,
                    'message' => __('voyager::media.file_removed'),
                ],
            ]);
        } catch (Exception $e) {
            $code = 500;
            $message = __('voyager::generic.internal_error');

            if ($e->getCode()) {
                $code = $e->getCode();
            }

            if ($e->getMessage()) {
                $message = $e->getMessage();
            }

            return response()->json([
                'data' => [
                    'status'  => $code,
                    'message' => $message,
                ],
            ], $code);
        }
    }
}
