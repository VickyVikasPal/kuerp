<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use App\Common\SoftdevController;
use App\Http\Controllers\Controller;

class AppController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
      //  $this->LogInfo('Begin: Apps.controller->index()');

        return view('index');
    }
}
