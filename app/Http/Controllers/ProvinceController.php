<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Province;
use App\Models\Street;

// Events
use App\Events\TurnOnProvinceEvent;
use App\Events\TurnOffProvinceEvent;
use App\Events\BrightnessChangeProvinceEvent;

class ProvinceController extends Controller
{
    protected $model;

    public function __construct(Province $model)
    {
        $this->model = $model;
    }

    public function list()
    {
        $data['provinces'] = $this->model->latest('id')->with('lamps')->get();
        return view('admin.provinces.index', $data);
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

    public function turnOnAll()
    {
        $provinces = $this->model->all();
        foreach ($provinces as $province) {
            event(new TurnOnProvinceEvent($province));
        }

        return redirect()->route('user.provinces.list');
    }

    public function turnOffAll()
    {
        $provinces = $this->model->all();
        foreach ($provinces as $province) {
            event(new TurnOffProvinceEvent($province));
        }

        return redirect()->route('user.provinces.list');
    }

    public function turnMaxAll()
    {
        $this->setLevelAll(10);
        return redirect()->route('user.provinces.list');
    }

    public function turnMidAll()
    {
        $this->setLevelAll(5);
        return redirect()->route('user.provinces.list');
    }

    private function setLevelAll($level)
    {
        $provinces = $this->model->all();
        foreach ($provinces as $province) {
            event(new BrightnessChangeProvinceEvent($province, $level));
        }
    }

    public function show($id)
    {
        $province = $this->model->findOrFail($id);

        $data['streets'] = $province->streets;
        return view('admin.dashboard.index', $data);
    }
}
