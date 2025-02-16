<?php

namespace App\Http\Controllers;

use App\Models\ElectionSettings;
use Illuminate\Http\Request;

class ElectionSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['elections'] = ElectionSettings::orderByDesc('start_date')->get();
        return view('admin.elections.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'name' => ['required'],
            'display_title' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'start_time' => ['required'],
            'end_time' => ['required'],
        ]);

        $check = ElectionSettings::where('status', '<=', 1)->count();
        if ($check > 0) {
            return redirect(route('elections', absolute: false))->with('error', 'There is a Pending or In Progress Election......');
        }

        ElectionSettings::firstOrCreate(
            [
                'name' => $request->name,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ],
            [
                'display_title' => $request->display_title,
                'description' => $request->description,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'status' => 0, //$request->status,
                'created_by' => get_logged_in_user_id(),
                'updated_by' => get_logged_in_user_id(),
            ]
        );

        return redirect(route('elections', absolute: false))->with('success', 'Election Created Successfully!!!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'name' => ['required'],
            'display_title' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'start_time' => ['required'],
            'end_time' => ['required'],
        ]);

//        $check = ElectionSettings::select('id')->where('status', '<=', 1)->get();
//        dd($check)
//        if (count($check) > 0 && ($request->status == 0 || $request->status == 1) && $check->id != $request->id) {
//            return redirect(route('elections', absolute: false))->with('error', 'There is a Pending or In Progress Election......');
//        }

        ElectionSettings::find($request->id)->update(
            [
                'name' => $request->name,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'display_title' => $request->display_title,
                'description' => $request->description,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'status' => $request->status,
                'updated_by' => get_logged_in_user_id(),
            ]
        );

        return redirect(route('elections', absolute: false))->with('success', 'Election Updated Successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        ElectionSettings::find($request->id)->delete();

        return redirect(route('elections', absolute: false))->with('success', 'Election Deleted Successfully!!!');
    }
}
