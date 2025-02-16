<?php

namespace App\Http\Controllers;

use App\Models\VotingPosition;
use Illuminate\Http\Request;

class VotingPositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['positions'] = VotingPosition::orderByDesc('election_id')->get();
        return view('admin.voting_positions.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'election_id' => ['required'],
            'position_name' => ['required'],
        ]);

        VotingPosition::firstOrCreate(
            [
                'election_id' => $request->election_id,
                'position_name' => $request->position_name,
            ],
            [
                'created_by' => get_logged_in_user_id(),
                'updated_by' => get_logged_in_user_id(),
            ]
        );

        return redirect(route('voting_positions', absolute: false))->with('success', 'Position Created Successfully!!!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'election_id' => ['required'],
            'position_name' => ['required'],
        ]);

        VotingPosition::find($request->id)->update(
            [
                'election_id' => $request->election_id,
                'position_name' => $request->position_name,
                'updated_by' => get_logged_in_user_id(),
            ]
        );

        return redirect(route('voting_positions', absolute: false))->with('success', 'Position Updated Successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        VotingPosition::find($request->id)->delete();

        return redirect(route('voting_positions', absolute: false))->with('success', 'Position Deleted Successfully!!!');
    }
}
