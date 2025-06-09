<?php

namespace App\Controllers;

class StaticPagesController extends BaseController
{
    public function terms()
    {
        return view('static/terms');
    }

    public function privacy()
    {
        return view('static/privacy');
    }
}
