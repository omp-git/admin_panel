<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user');
    }

    public function index()
    {
        $tests = Test::whereStatus(true)->select(['id', 'slug', 'name'])->get();
        return view('tests.index', compact('tests'));
    }

    public function show($id)
    {
        $test = Test::findOrFail($id);
        return view('tests.show', compact('test'));
    }
}
