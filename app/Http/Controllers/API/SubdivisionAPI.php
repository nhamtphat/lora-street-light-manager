<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;

class SubdivisionAPI extends Controller
{
    //**********************************//
    // LẤY CÁC QUẬN HUYỆN CỦA MỘT TỈNH
    //**********************************//
    public function getDistricts($province_id) {
        $districts = Province::findOrFail($province_id)->districts;
        return json_encode($districts);
    }
    
    
    //**********************************//
    // LẤY XÃ PHƯỜNG CỦA MỘT HUYỆN
    //**********************************//
    public function getWards($district_id) {
        $wards = District::findOrFail($district_id)->wards;
        return json_encode($wards);
    }
}