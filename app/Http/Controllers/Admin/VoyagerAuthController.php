<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\VoyagerAuthController as BaseVoyagerAuthController;

class VoyagerAuthController extends BaseVoyagerAuthController
{
    protected function loggedOut(Request $request)
    {
        return redirect('voyager.login');
    }
    public function logout(Request $request)
    {
        $this->guard()->logout();

//        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/');
    }
}
