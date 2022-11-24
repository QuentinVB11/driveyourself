<?php

namespace App\Http\Controllers;
use App\Models\Path;

class PathController extends Controller
{


    public function pagePaths()
    {

        return view('paths', ['paths' => Path::all() ]);
    }
}
