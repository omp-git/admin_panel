<?php
/**
 * Created by PhpStorm.
 * User: OMP
 * Date: 18/03/2019
 * Time: 11:29 AM
 */

namespace App\FormFields;

use TCG\Voyager\FormFields\AbstractHandler;

class IconFormField extends AbstractHandler
{
    protected $codename = 'icon';
    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        return view('formfields.icon', [
            'row' => $row,
            'options' => $options,
            'dataType' => $dataType,
            'dataTypeContent' => $dataTypeContent
        ]);
    }
}