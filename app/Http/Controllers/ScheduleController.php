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

    public function getDelete($schedule_id)
    {
        $schedule = Schedule::findOrFail($schedule_id);
        $schedule->delete();
        return $this->getList();
    }

    public function getEdit($schedule_id)
    {
        $data['schedule'] = Schedule::findOrFail($schedule_id);
        return view('schedule-edit', $data);
    }

    public function postEdit($schedule_id, Request $req)
    {
        $schedule = Schedule::findOrFail($schedule_id);
        $data = $req->only(['name', 'time', 'percent', 'state']);
        $schedule->update($data);

        return redirect()->route('user.schedule.list.get');
    }
}
