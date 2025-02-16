<?php

namespace App\Http\Controllers;

use App\Models\BallotPosition;
use App\Models\Candidate;
use App\Models\ElectionSettings;
use App\Models\User;
use App\Models\Vote;
use App\Models\Voter;
use App\Models\VotingPosition;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function create($type){
        switch ($type) {
            case 'createElection':
                return view('admin.elections.create_form');

            case 'createUser':
                return view('admin.users.create_form');

            case 'createVoter':
                $data['election'] = ElectionSettings::select('id', 'name')->where('status', '<=', 1)->get();
                return view('admin.voters.create_form', $data);

            case 'createVotingPosition':
                $data['election'] = ElectionSettings::select('id', 'name')->where('status', '<=', 1)->get();
                return view('admin.voting_positions.create_form', $data);

            case 'createCandidate':
                $data['election'] = ElectionSettings::select('id', 'name')->where('status', '<=', 1)->get();
                $data['voting_position'] = VotingPosition::select('id', 'position_name as name')->where('id', 0)->get();
                return view('admin.candidates.create_form', $data);

            case 'viewVotersRegister':
                $election = ElectionSettings::select('id')->where('status', '<=', 1)->first();
                if($election){
                    $data['voters'] = Voter::where('election_id', $election->id)->orderby('name')->get();
                    return view('vote.index', $data);
                }
                return "No Election Set!!! See System Admin!!!!";

            case 'voteLoginPage':
                return view('vote.login');

            case 'viewAllVotes':
                $data['election'] = ElectionSettings::select('id', 'name')->where('status', '>=', 1)->get();
                return view('admin.votes.create_form', $data);

            case 'viewReport':
                $data['election'] = ElectionSettings::select('id', 'name')->where('status', '>=', 1)->get();
                return view('admin.reports.create_form', $data);

            default:
                return "No form found";
        }
    }

    public function edit($type, $id){
        switch ($type) {
            case 'editElection':
                $data['election'] = ElectionSettings::find($id);
                return view('admin.elections.create_form', $data);

            case 'editUser':
                $data['user'] = User::find($id);
                return view('admin.users.create_form', $data);

            case 'editVoter':
                $data['election'] = ElectionSettings::select('id', 'name')->where('status', '<=', 1)->get();
                $data['voter'] = Voter::find($id);
                return view('admin.voters.create_form', $data);

            case 'editVotingPosition':
                $data['election'] = ElectionSettings::select('id', 'name')->where('status', '<=', 1)->get();
                $data['position'] = VotingPosition::find($id);
                return view('admin.voting_positions.create_form', $data);

            case 'editCandidate':
                $data['election'] = ElectionSettings::select('id', 'name')->where('status', '<=', 1)->get();
                $data['candidate'] = Candidate::find($id);
                $data['voting_position'] = VotingPosition::select('id', 'position_name as name')->where('id', $data['candidate']->position)->get();
                return view('admin.candidates.create_form', $data);

            default:
                return "No form found";
        }
    }

    public function view($type, $id){
        switch ($type) {
            case 'viewElection':
                $data['election'] = ElectionSettings::find($id);
                return view('admin.elections.view_form', $data);

            case 'viewBallot':
                $data['ballots'] = BallotPosition::where('voting_position_id', $id)->orderBy('position')->get();
                return view('admin.ballot_position.view_form', $data);

            case 'viewCandidate':
                $data['candidate'] = Candidate::find($id);
                return view('admin.candidates.view_form', $data);

            case 'castingVote':
                $data['ballots'] = BallotPosition::where('voting_position_id', $id)->orderBy('position')->get();
                return view('vote.vote_form', $data);

            case 'castedVoted':
                $data['vote'] = Vote::find($id);
                $data['candidate'] = Candidate::find($data['vote']->candidate_id);
                $data['position'] = VotingPosition::find($data['vote']->voting_position_id);
                return view('vote.your_vote_form', $data);

            default:
                return "No form found";
        }
    }

    public function delete($type, $id){
        switch ($type) {
            case 'deleteElection':
                return view('admin.elections.delete_form', ['election' => $id]);

            case 'deleteUser':
                return view('admin.users.delete_form', ['user' => $id]);

            case 'deleteVoter':
                return view('admin.voters.delete_form', ['voter' => $id]);

            case 'deleteVotingPosition':
                return view('admin.voting_positions.delete_form', ['position' => $id]);

            default:
                return "No form found";
        }
    }
}
