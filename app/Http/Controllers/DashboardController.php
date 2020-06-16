<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Street;

class DashboardController extends Controller
{
    public function getView()
    {
        $data['streets'] = Street::all();
        return view('dashboard', $data);
    }
}
