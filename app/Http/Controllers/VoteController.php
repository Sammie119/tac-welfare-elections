<?php

namespace App\Http\Controllers;

use App\Models\BallotPosition;
use App\Models\ElectionSettings;
use App\Models\Vote;
use App\Models\Voter;
use App\Models\VotingPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['election'] = ElectionSettings::where('status', '<=', 1)->first();
        $data['ballots'] = VotingPosition::where('election_id', $data['election']->id)->get();
        return view('dashboard', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $vote = BallotPosition::find($request->ballot_id);
        $voter = Voter::where('voters_id', Auth::user()->email)->first();

        Vote::create([
                'election_id' => $vote->election_id,
                'voter_id' => $voter->id,
                'candidate_id' => $vote->candidate_id,
                'voting_position_id' => $vote->voting_position_id,
                'status' => 1,
            ]);

        return redirect('/dashboard')->with('success', 'Vote Cast Successfully!!!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function getAllVotes()
    {
        $data['elections'] = ElectionSettings::where('status', 2)->get();
        return view('admin.votes.index', $data);
    }

    public function votesCast(Request $request)
    {
        $data['votes'] = Vote::where('election_id', $request->election_id)->get();
        return view('admin.votes.index', $data);
    }

    public function getReport()
    {
        $data['elections'] = ElectionSettings::where('status', 2)->get();
        return view('admin.reports.index', $data);
    }

    public function getGenerate(Request $request)
    {
//        dd($request->all());

        $data['votes'] = DB::table('vw_votes')->where('election_id', $request->election_id)->get();
        $data['total_votes'] = DB::table('vw_votes')->selectRaw("voting_position_id, sum(votes) as total_votes")
            ->where('election_id', $request->election_id)
            ->groupBy('voting_position_id')
            ->get();
        $data['voting_positions'] = VotingPosition::select('id', 'position_name')->where('election_id', $request->election_id)->get();
        return view('admin.reports.election_report', $data);
    }

    public function getVoterCode(Request $request)
    {
        $election = ElectionSettings::select('id')->where('status', '=', 1)->first();
        if($election){
            $voter = Voter::where('voters_id', '=', $request['voter_id'])
                ->where('election_id', $election->id)
                ->first();

            if($voter){
                $msg = "$voter->name,\n Your e-Voting access,\n Voter ID: $voter->voters_id \n Code: $voter->code";
                SMSController::sendSMS($voter->mobile_number, $msg);
                return response()->json(['voter' => 1]);
            }

            return response()->json(['voter' => 2]);
        }

        return response()->json(['voter' => 0]);
    }

    public function printElectionReport($election_id)
    {
        $data['votes'] = DB::table('vw_votes')->where('election_id', $election_id)->get();
        $data['total_votes'] = DB::table('vw_votes')->select('voting_position_id', 'sum(votes) as total_votes')
            ->where('election_id', $election_id)
            ->groupBy('voting_position_id')
            ->get();
        $data['voting_positions'] = VotingPosition::select('id', 'position_name')->where('election_id', $election_id)->get();
        return view('admin.reports.print_election_report', $data);
    }
}
