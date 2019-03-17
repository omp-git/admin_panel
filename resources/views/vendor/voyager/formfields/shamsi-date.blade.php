@inject("calendarUtils", "Morilog\Jalali\CalendarUtils")
{{-- check type of page --}}
@if($action == 'edit' || $action == 'add')
    @php
    $format = property_exists($row->details, 'format') ? $row->details->format : 'Y-m-d H:i:s';
    @endphp
    <input @if($row->required == 1) required @endif type="datetime" class="form-control datetime" name="{{ $row->field }}" dir="rtl"
           value="{{  old($row->field, $dataTypeContent->{$row->field}) }}">
    @push('javascript')
        <script type="text/javascript" src="{{ asset('js/persian-datepicker.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/persian-date.js') }}"></script>
        <script type="text/javascript">
            $(function () {
                $(".datetime").persianDatepicker({
                    format: 'YYYY-MM-DD HH:mm:ss',
                    timePicker: {
                        enabled: true,
                        meridiem: {
                            enabled: true
                        }
                    }

                });
            });
        </script>
    @endpush
@elseif($action == 'browse')
    @php
        if(property_exists($row->details, 'show_format'))
        $format = $row->details->show_format;
        elseif(property_exists($row->details, 'format'))
            $format = $row->details->format;
        else
            $format = 'Y-m-d H:i:s';
    @endphp
    {{ $calendarUtils::strftime($format, strtotime($data->{$row->field}))}}

@else
    @php
        if(property_exists($row->details, 'show_format'))
        $format = $row->details->show_format;
        elseif(property_exists($row->details, 'format'))
            $format = $row->details->format;
        else
            $format = 'Y-m-d H:i:s';
    @endphp
    {{ $calendarUtils::strftime($format, strtotime($dataTypeContent->{$row->field}))}}
@endif

