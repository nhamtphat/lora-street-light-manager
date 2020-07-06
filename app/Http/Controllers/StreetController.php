<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Street;
use App\Models\Lamp;
use Illuminate\Support\Arr;

class StreetController extends Controller
{
    /**
     * Lấy danh sách tất cả các tuyến đường
     *
     * @return void
     */
    public function getList()
    {
        $data['streets'] = Street::all();
        return view('street-list', $data);
    }


    /**
     * Nhập thông tin để thêm tuyến đường mới
     *
     * @return void
     */
    public function getAdd()
    {
        return view('street-add');
    }


    /**
     * Thêm tuyến đường và các đèn vào CSDL
     *
     * @return void
     */
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

    /**
     * Sửa thông tin một tuyến đường nào đó
     *
     * @return void
     */
    public function getEdit($street_id)
    {
        $data['street'] = Street::findOrFail($street_id);
        return view('street-edit', $data);
    }
    
    /**
     * Lưu lại thay đổi những thay đổi chỉnh sửa
     * Những đèn nào không còn thuộc tuyến thì xoá đi
     * Thêm những đèn mới vào
     *
     * @return void
     */
    public function postEdit($street_id, Request $req)
    {
        $street = Street::findOrFail($street_id);
        $street->name = $req->name;
        $street->save();
        $lampofstreet = $street->lamps->pluck('uid')->toArray();
        $willadd = array_diff($req->lamp_uid, $lampofstreet);
        $willdel = array_diff($lampofstreet, $req->lamp_uid);
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

    /**
     * Xoá một tuyến đường
     *
     * @return void
     */
    public function getDelete($street_id)
    {
        $street = Street::findOrFail($street_id);
        $street->lamps()->delete();
        $street->delete();
        return redirect()->route('user.street.list.get');
    }

    /**
     * Dùng curl gửi dữ liệu đến ESP, với các tên miền được lưu sẵn
     *
     * @return response
     */
    public function sendToESP($street_id, $level)
    {
        $street = Street::findOrFail($street_id);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            // CURLOPT_URL => 'http://'.$street->domain.'/?ledid=0000&level='.sprintf("%02d", $level),
            CURLOPT_URL => 'https://light.techking.vn/ok',
            CURLOPT_USERAGENT => $_SERVER['HTTP_USER_AGENT'],
            CURLOPT_SSL_VERIFYPEER => false
        ));
        $resp = curl_exec($curl);
        return $resp;
    }

    /**
     * Thay đổi trạng thái đèn của tuyến đường
     * Nếu ON => OFF, nếu OFF => ON
     *
     * @return void
     */
    public function getOnoff($street_id)
    {
        $street = Street::findOrFail($street_id);
        if($street->state=='on') {
            $resp = $this->sendToESP($street->id, 0);
            if ($resp == 'OK') $street->update(['state' => 'off']);
        }

        
        elseif($street->state=='off') {
            $resp = $this->sendToESP($street->id, $street->percent);
            if ($resp == 'OK') $street->update(['state' => 'on']);
        }
        return redirect()->back();
    }

    /**
     * Ajax thay đổi độ sáng của đèn
     * Nếu đèn đang bật, gửi đến ESP
     *
     * @return void
     */
    public function getPercent($street_id, $value)
    {
        $street = Street::findOrFail($street_id);
        $street->update(['percent' => $value]);

        if ($street->state == 'on') {
            $resp = $this->sendToESP($street->id, $street->percent);
            return 'Đã điều chỉnh độ sáng thành mức '.$value.'.';
        }

        return 'Đèn đang tắt, độ sáng được lưu thành mức '.$value.'.';
    }
}