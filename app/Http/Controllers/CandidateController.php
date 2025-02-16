<?php

namespace App\Http\Controllers;

use App\Models\BallotPosition;
use App\Models\Candidate;
use App\Models\VotingPosition;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['candidates'] = Candidate::orderByDesc('election_id')->get();
        return view('admin.candidates.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'election_id' => ['required'],
            'name' => ['required'],
            'position' => ['required'],
            'picture' => ['required', 'file', 'image', 'max:1024', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);

        if($request->file('picture') != null){
            $request['file_url'] = $this->imageUpload($request->file('picture'), 'candidates');
        }

        Candidate::firstOrCreate(
            [
                'election_id' => $request->election_id,
                'name' => $request->name,

            ],
            [
                'position' => $request->position,
                'picture' => $request->file_url,
                'description' => $request->description,
                'created_by' => get_logged_in_user_id(),
                'updated_by' => get_logged_in_user_id(),
            ]
        );

        return redirect(route('candidates', absolute: false))->with('success', 'Candidate Created Successfully!!!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'election_id' => ['required'],
            'name' => ['required'],
            'position' => ['required'],
            'picture' => ['file', 'image', 'max:1024', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);

        $candidate = Candidate::find($request->id);

        if($request->file('picture') != null){
            $request['file_url'] = $this->imageUpload($request->file('picture'), 'candidates', $candidate->picture);
        }

        $candidate->update(
            [
                'election_id' => $request->election_id,
                'name' => $request->name,
                'position' => $request->position,
                'picture' => ($request->file('picture') != null) ? $request->file_url : $candidate->picture,
                'description' => $request->description,
                'updated_by' => get_logged_in_user_id(),
            ]
        );

        BallotPosition::where('candidate_id', $request->id)->update([
            'election_id' => $request->election_id,
            'updated_by' => get_logged_in_user_id()
        ]);

        return redirect(route('candidates', absolute: false))->with('success', 'Candidate Updated Successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Candidate::find($request->id)->delete();

        return redirect(route('candidates', absolute: false))->with('success', 'Candidate Deleted Successfully!!!');
    }

    public function getVotingPositions(Request $request)
    {
        $positions = VotingPosition::where('election_id', $request->election)->orderBy('position_name')->get();

        foreach ($positions as $position) {
            echo "<option value='".$position->id."'>".$position->position_name."</option>";
        }
    }
}
