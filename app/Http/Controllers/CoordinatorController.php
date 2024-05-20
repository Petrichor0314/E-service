<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoordinatorController extends Controller
{
    public function something()
    {
        return view('coordinator.coord_ability');
    }
}
