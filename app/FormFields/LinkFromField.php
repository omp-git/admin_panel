<?php
/**
 * Created by PhpStorm.
 * User: OMP
 * Date: 17/03/2019
 * Time: 05:37 PM
 */

namespace App\FormFields;

use TCG\Voyager\FormFields\AbstractHandler;

class LinkFromField extends AbstractHandler
{
    protected $codename = 'link';
    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        return view('vendor.voyager.formfields.link', [
            'row' => $row,
            'options' => $options,
            'dataType' => $dataType,
            'dataTypeContent' => $dataTypeContent,
//            'name' => $this->handle($row, $dataType,$dataTypeContent)
        ]);
    }
}