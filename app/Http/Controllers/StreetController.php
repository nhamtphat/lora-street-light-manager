<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Street;
use App\Models\Lamp;
use Illuminate\Support\Arr;

class StreetController extends Controller
{
    public function getList()
    {
        $data['streets'] = Street::all();
        return view('street-list', $data);
    }

    public function getAdd()
    {
        return view('street-add');
    }

    public function postAdd(Request $req)
    {
        $lamps = Lamp::whereIn('uid', $req->lamp_uid)->get();
        if($lamps->count() > 0) {
            return redirect()->back()->withInput()->withError('Trùng các id '.$lamps->pluck('uid'));
        }

        $data['name'] = $req->name;
        $street = Street::create($data);

        foreach($req->lamp_uid as $lamp_uid) {
            $lamp_data = [
                'uid' => $lamp_uid,
                'street_id' => $street->id
            ];
            $lamp_id = Lamp::create($lamp_data);
        }

        return redirect()->route('user.street.list.get');
    }

    public function getEdit($street_id)
    {
        $data['street'] = Street::findOrFail($street_id);
        return view('street-edit', $data);
    }
    
    public function postEdit($street_id, Request $req)
    {
        $street = Street::findOrFail($street_id);
        $street->name = $req->name;
        $street->save();
        $willadd = array_diff($req->lamp_uid, $street->lamps->pluck('uid')->toArray());
        $willdel = array_diff($street->lamps->pluck('uid')->toArray(), $req->lamp_uid);
        Lamp::whereIn('uid', $willdel)->delete();
        
        foreach($willadd as $lamp_uid) {
            $lamp_data = [
                'uid' => $lamp_uid,
                'street_id' => $street->id
            ];
            $lamp_id = Lamp::create($lamp_data);
        }

        return redirect()->route('user.street.edit.get', ['id'=>$street->id])->with('success', 'Lưu thay đổi thành công!'); 
    }

    public function getDelete($street_id)
    {
        $street = Street::findOrFail($street_id);
        $street->lamps()->delete();
        $street->delete();
        return redirect()->route('user.street.list.get');
    }

    public function getOnoff($street_id)
    {
        $street = Street::findOrFail($street_id);
        if($street->state=='on') { $street->state = 'off'; }
        elseif($street->state=='off') { $street->state = 'on'; }
        $street->save();
        return redirect()->back();
    }

    public function getPercent($street_id, $value)
    {
        $street = Street::findOrFail($street_id);
        $street->percent = $value;
        $street->save();

        return 'OK';
    }
}