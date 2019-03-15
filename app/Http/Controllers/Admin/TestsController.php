<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class TestsController extends VoyagerBaseController
{
    public function update(Request $request, $id)
    {
        $slug = $this->getSlug($request);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        foreach ($dataType->editRows as $row)
        {
            if($row->type == 'timestamp')
            {
                if(isset($row->details)) {
                    $options = ($row->details);
                    if(isset($options->type) && $options->type == 'shamsi') {
                        $date = tr_num($request->{$row->field});
                        $format = isset($options->format) ? $options->format : 'Y-m-d H:i:s';
                        $date = \Morilog\Jalali\CalendarUtils::createCarbonFromFormat($format, $date)->format($format);

                        $request->merge([$row->field => $date]);
                    }
                }
            }
        }
        return parent::update($request, $id);
    }
    public function store(Request $request)
    {
        $slug = $this->getSlug($request);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        foreach ($dataType->editRows as $row)
        {
            if($row->type == 'timestamp')
            {
                if(isset($row->details)) {
                    $options = ($row->details);
                    if(isset($options->type) && $options->type == 'shamsi') {
                        $date = tr_num($request->{$row->field});
                        $format = isset($options->format) ? $options->format : 'Y-m-d H:i:s';
                        $date = \Morilog\Jalali\CalendarUtils::createCarbonFromFormat($format, $date)->format($format);

                        $request->merge([$row->field => $date]);
                    }
                }
            }
        }
        return parent::store($request);
    }
}
