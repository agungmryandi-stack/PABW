<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebandooController extends Controller
{
    public function beranda()
    {
        return view('webandoo.beranda');
    }
    public function peta()
    {
        return view('webandoo.peta');
    }
    public function edukasi()
    {
        return view('webandoo.edukasi');
    }
    public function event()
    {
        return view('webandoo.event');
    }
    public function kuliner()
    {
        return view('webandoo.kuliner');
    }
    public function sejarah()
    {
        return view('webandoo.sejarah');
    }
}