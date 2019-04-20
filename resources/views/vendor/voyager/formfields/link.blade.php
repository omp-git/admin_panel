{{-- check type of page --}}
{{--{{ dd(get_defined_vars()) }} // get all of access variables --}}
@if($action == 'edit' || $action == 'add')
    <input @if($row->required == 1) required @endif type="text" class="form-control" name="{{ $row->field }}"
           placeholder="{{ isset($options->placeholder)? old($row->field, $options->placeholder): $row->display_name }}"
           value="{{ $dataTypeContent->{$row->field} ?? old($row->field) ?? $options->default ?? '' }}">
@elseif($action == 'browse')
        <a href="{{ $data->{$row->field} }}" target="_blank">{{ $data->{$row->field} }}</a>
    @endif

