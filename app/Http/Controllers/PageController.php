<?php

namespace App\Http\Controllers;

require 'Classes/Data.php';

use Illuminate\Http\Request;
use Custom\Data as Data;

class PageController extends Controller
{
    public function index()
    {
        $data = new Data();
        $dispString = null;
        return view('forms.form')->with(['data' => $data, 'dispString' => $dispString]);
    }

    //public function submission(Request $request)
    //{
    //    dump($request->all());
    //}
}
