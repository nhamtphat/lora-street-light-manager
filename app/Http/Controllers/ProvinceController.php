<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Province;
use App\Models\Street;

// Events
use App\Events\TurnOnProvinceEvent;
use App\Events\TurnOffProvinceEvent;

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

    public function turnOn($id)
    {
        $province = $this->model->findOrFail($id);
        event(new TurnOnProvinceEvent($province));

        return redirect()->route('user.provinces.list');
    }

    public function turnOff($id)
    {
        $province = $this->model->findOrFail($id);
        event(new TurnOffProvinceEvent($province));

        return redirect()->route('user.provinces.list');
    }
}
