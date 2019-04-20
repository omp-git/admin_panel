@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tests</div>

                    <div class="card-body">
                        @foreach($tests as $test)
                            <div class="test-item">
                                <a href="{{ route('tests.show', $test->{'slug_' . getLocale()}) }}"><h4>{{ ++$loop->index . ' - ' .
                                $test->getTranslatedAttribute('name', getLocale(), true) }}</h4></a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection