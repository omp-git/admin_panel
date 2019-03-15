<div class="panel widget center bgimage" style="margin-bottom:0;overflow:hidden;background-image:url('{{ $image }}');">
    <div class="dimmer"></div>
    <div class="panel-content">
        @if (isset($icon))<i class='{{ $icon }}'></i>@endif
        {!! $title !!}
        {{--<p>{!! $text !!}</p>--}}
        <a href="{{ $button['link'] }}" class="btn btn-outline-primary">{!! $button['text'] !!}</a>
    </div>
</div>
