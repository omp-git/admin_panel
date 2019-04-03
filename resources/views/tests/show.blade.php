@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tests</div>

                    <div class="card-body">
                        <div class="test-item">
                            <div class="test-item-header">
                                <h3>{{ $test->getTranslatedAttribute('name', getLocale(), 'en') }}</h3>
                            </div>
                            <div class="tests-item-body row">
                                <div class="col-12 col-md-6">
                                    <p>{{ $test->getTranslatedAttribute('body', getLocale(), 'en') }}</p>
                                </div>
                                <div class="col-12 col-md-6 text-center">
                                    <img class="main" src="{{ Voyager::image($test->image) }}" alt="{{ $test->name }}">
                                </div>
                                <div class="col-12 mt-2">
                                    <img class="cropped float-left" src="{{ Voyager::image($test->thumbnail('cropped')) }}" alt="{{ $test->name }}">
                                    <img class="small float-left mr-2" src="{{ Voyager::image($test->thumbnail('small')) }}" alt="{{ $test->name }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
