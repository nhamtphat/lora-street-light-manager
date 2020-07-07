<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function getList()
    {
        $data['schedules'] = Schedule::all();
        return view('schedule-list', $data);
    }
    public function getAdd()
    {
        return view('schedule-add');
    }

    public function postAdd(Request $req)
    {
        Schedule::create($req->only(['name', 'time', 'state', 'percent']));
        return redirect()->route('user.schedule.list.get');
    }
}
