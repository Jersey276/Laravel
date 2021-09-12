<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function errorFlash(Request $request, String $message)
    {
        $request->session()->flash('status-type','danger');
        $this->flash($request, $message);
    }

    protected function successFlash(Request $request, String $message)
    {
        $request->session()->flash('status-type','success');
        $this->flash($request, $message);
    }

    private function flash(Request $request, String $message)
    {
        $request->session()->flash('status-message', $message);
    }
}
