<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Province;
use App\Models\Street;

class ProvinceController extends Controller
{
    protected $model;

    public function __construct(Province $model)
    {
        $this->model = $model;
    }

    public function list()
    {
        $data['provinces'] = $this->model->with('lamps')->get();
        return view('admin.provinces.list', $data);
    }

    public function getListOfLamps($id)
    {
        $province = $this->model->findOrFail($id);
        $lamps = $province->lamps;
        
        dd($lamps);
    }
}
