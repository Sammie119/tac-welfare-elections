<?php

namespace App\Http\Controllers;

use App\Models\BallotPosition;
use App\Models\ElectionSettings;
use App\Models\VotingPosition;
use Illuminate\Http\Request;

class BallotPositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['ballots'] = VotingPosition::orderBy('election_id', 'desc')->get();
        return view('admin.ballot_position.index', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'id' => ['required'],
            'position' => ['required'],
        ]);

        $checkElectionStatus = ElectionSettings::find($request->election_id)->status;

        if($checkElectionStatus !== 0){
            return redirect()->route('ballots')->with('error', 'Sorry! You cannot Set Ballot Positions. Election has started or its Completed');
        }

        foreach ($request->id as $key => $ballot_id) {
            BallotPosition::find($ballot_id)->update([
                'position' => $request->position[$key],
                'updated_by' => get_logged_in_user_id(),
            ]);
        }

        return redirect(route('ballots', absolute: false))->with('success', 'Balloting Done Successfully!!!');
    }
}
