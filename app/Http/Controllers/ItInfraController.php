<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItInfraController extends Controller
{
    public function index()
    {
        return view('ItInfra.dashboard');
    }

    public function EmailIdCreation()
    {
        return view('ItInfra.EmailIdCreation');
    }


}
