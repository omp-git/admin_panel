<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user');
    }

    public function index()
    {
        $tests = Test::whereStatus(true)->select(['id', 'slug_' . getLocale(), 'name'])->orderBy('order','asc')->get();
        return view('tests.index', compact('tests'));
    }

    public function show($slug)
    {
        $locales = config('voyager.multilingual.locales');
        foreach ($locales as $locale)
        {
            $test = Test::where('slug_' . $locale, $slug)->where('status', true)->first();
            if($test) {
                return view('tests.show', compact('test'));
            }
        }
            return abort(404);
    }
}
