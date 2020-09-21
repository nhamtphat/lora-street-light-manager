<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function list()
    {
        $data['schedules'] = Schedule::all();
        return view('admin.schedules.list', $data);
    }
    public function create()
    {
        return view('admin.schedules.create');
    }

    public function store(Request $req)
    {
        Schedule::create($req->only(['name', 'time', 'state', 'percent']));
        return redirect()->route('user.schedules.list');
    }

    public function delete($schedule_id)
    {
        $schedule = Schedule::findOrFail($schedule_id);
        $schedule->delete();
        
        return redirect()->route('user.schedules.list');
    }

    public function edit($schedule_id)
    {
        $data['schedule'] = Schedule::findOrFail($schedule_id);
        return view('admin.schedules.edit', $data);
    }

    public function update($schedule_id, Request $req)
    {
        $schedule = Schedule::findOrFail($schedule_id);
        $data = $req->only(['name', 'time', 'percent', 'state']);
        $schedule->update($data);

        return redirect()->route('user.schedules.list');
    }
}
