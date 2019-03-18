{{-- check type of page --}}
{{--{{ dd(get_defined_vars()) }} // get all of access variables --}}
@if($action == 'edit' || $action == 'add')
    <input @if($row->required == 1) required @endif type="text" class="form-control" name="{{ $row->field }}"
           placeholder="{{ isset($options->placeholder)? old($row->field, $options->placeholder): $row->display_name }}"
           value="{{ $dataTypeContent->{$row->field} ?? old($row->field) ?? $options->default ?? '' }}">
@elseif($action == 'browse')
    <i class="bigger-150 {{ $data->{$row->field} }}" title="{{ $data->{$row->field} }}"
       style="color: {{ $data->color ? $data->color :  '#76838f' }};"></i>
@endif