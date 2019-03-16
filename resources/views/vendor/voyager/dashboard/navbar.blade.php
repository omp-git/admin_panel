@inject("carbon", "Carbon\Carbon")
<nav class="navbar navbar-default navbar-fixed-top navbar-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button class="hamburger btn-link">
                <span class="hamburger-inner"></span>
            </button>
            @section('breadcrumbs')
                <ol class="breadcrumb hidden-xs">
                    @php
                        $segments = array_filter(explode('/', str_replace(route('voyager.dashboard'), '', Request::url())));
                        $url = route('voyager.dashboard');
                    @endphp
                    @if(count($segments) == 0)
                        <li class="active"><i class="voyager-boat"></i> {{ __('voyager::generic.dashboard') }}</li>
                    @else
                        <li class="active">
                            <a href="{{ route('voyager.dashboard')}}"><i
                                        class="voyager-boat"></i> {{ __('voyager::generic.dashboard') }}</a>
                        </li>
                        @foreach ($segments as $segment)
                            @php
                                $url .= '/'.$segment;
                            @endphp
                            @if ($loop->last)
                                <li>{{ ucfirst($segment) }}</li>
                            @else
                                <li>
                                    <a href="{{ $url }}">{{ is_numeric($segment) && __('voyager::generic.is_rtl') == 'true' ?
                                'id=' . ucfirst($segment) : ucfirst($segment) }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                </ol>
            @show
        </div>

        <ul class="nav navbar-nav @if (config('voyager.multilingual.rtl')) navbar-left @else navbar-right @endif">
            @php
            $c = new \App\Contact();
            $new_contact = $c->unreadList();
            @endphp
            @can('browse', $c)
            <li class="dropdown contacts">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                   aria-expanded="false" title="new messages"><span
                            class="voyager-mail bigger-140 text-warning"></span><span class="badge badge-warning badge-top">{{ $new_contact->count() }}</span></a>
                @if($new_contact->count() > 0)
                <ul class="dropdown-menu dropdown-menu-animated dropdown-menu-right">
                    <li class="contacts-header">
                        <p>{{ __('voyager::contact.new_contacts_list') }}</p>
                    </li>
                    <li class="contacts-body">
                        <ul id="body-scroll" class="dropdown">
                            @foreach($new_contact as $contact)
                            <li><a href="{{ route('voyager.contacts.show', $contact->id) }}">
                                    <p>
                                        <span class="voyager-person"></span><b>{{ $contact->name }}</b>
                                    </p>
                                    <p>
                                        <i class="voyager-alarm-clock text-info bigger-110"></i><small class="text-warning">{{ $carbon::parse($contact->created_at)->diffForHumans() }}</small>
                                    </p>
                                </a>
                            </li>
                            @if($loop->index < $new_contact->count()-1)
                            <li class="divider"></li>
                            @endif
                            @endforeach
                        </ul>
                    </li>
                    <li class="contacts-footer">
                        <a href="{{ route('voyager.contacts.index') }}">{{ __('voyager::contact.contacts_more_link') }}</a>
                    </li>
                </ul>
                @endif
            </li>
            @endcan

            <li class="dropdown profile">
                <a href="#" class="dropdown-toggle text-right" data-toggle="dropdown" role="button"
                   aria-expanded="false"><img src="{{ $user_avatar }}" class="profile-img"> <span
                            class="caret"></span></a>
                <ul class="dropdown-menu dropdown-menu-animated">
                    <li class="profile-img">
                        <img src="{{ $user_avatar }}" class="profile-img">
                        <div class="profile-body">
                            <h5>{{ app('VoyagerAuth')->user()->name }}</h5>
                            <h6>{{ app('VoyagerAuth')->user()->email }}</h6>
                        </div>
                    </li>
                    <li class="divider"></li>
                    <?php $nav_items = config('voyager.dashboard.navbar_items'); ?>
                    @if(is_array($nav_items) && !empty($nav_items))
                        @foreach($nav_items as $name => $item)
                            <li {!! isset($item['classes']) && !empty($item['classes']) ? 'class="'.$item['classes'].'"' : '' !!}>
                                @if(isset($item['route']) && $item['route'] == 'voyager.logout')
                                    <form action="{{ route('voyager.logout') }}" method="POST">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger btn-block">
                                            @if(isset($item['icon_class']) && !empty($item['icon_class']))
                                                &nbsp;<i class="{!! $item['icon_class'] !!}"></i>
                                            @endif
                                            {{__($name)}}
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ isset($item['route']) && Route::has($item['route']) ? route($item['route']) : (isset($item['route']) ? $item['route'] : '#') }}" {!! isset($item['target_blank']) && $item['target_blank'] ? 'target="_blank"' : '' !!}>
                                        @if(isset($item['icon_class']) && !empty($item['icon_class']))
                                            <i class="{!! $item['icon_class'] !!}"></i>
                                        @endif
                                        {{__($name)}}
                                    </a>
                                @endif
                            </li>
                        @endforeach
                    @endif
                </ul>
            </li>

        </ul>
    </div>
</nav>
