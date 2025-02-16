<?php

namespace App\Http\Controllers;

use App\Imports\VoterImport;
use App\Models\ElectionSettings;
use App\Models\User;
use App\Models\Voter;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class VoterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['voters'] = Voter::orderByDesc('election_id')->get();
        return view('admin.voters.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd($request->all());
        if(isset($request->file)){
            $request->validate([
                'file' => 'required|mimes:xlsx,xls,csv|max:1048',
            ]);

            Excel::import(new VoterImport, $request->file('file'));

            return redirect(route('voters', absolute: false))->with('success', 'Voters Uploaded Successfully!!!');

        } else {
            $request->validate([
                'election_id' => ['required'],
                'name' => ['required'],
                'voters_id' => ['required'],
                'mobile_number' => ['required'],
            ]);

            Voter::firstOrCreate(
                [
                    'election_id' => $request->election_id,
                    'name' => $request->name,
                    'voters_id' => $request->voters_id,
                ],
                [
                    'mobile_number' => $request->mobile_number,
                    'code' => intCodeRandom(),
                    'created_by' => get_logged_in_user_id(),
                    'updated_by' => get_logged_in_user_id(),
                ]
            );

            return redirect(route('voters', absolute: false))->with('success', 'Voter Created Successfully!!!');
        }
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
            'voters_id' => ['required'],
            'mobile_number' => ['required'],
        ]);

        $voter = Voter::find($request->id);

        User::where('email', $voter->voters_id)->update([
            'name' => $request->name,
            'email' => $request->voters_id,
        ]);

        $voter->update(
            [
                'election_id' => $request->election_id,
                'name' => $request->name,
                'voters_id' => $request->voters_id,
                'mobile_number' => $request->mobile_number,
                'updated_by' => get_logged_in_user_id(),
            ]
        );

        return redirect(route('voters', absolute: false))->with('success', 'Voter Updated Successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Voter::find($request->id)->delete();

        return redirect(route('voters', absolute: false))->with('success', 'Voter Deleted Successfully!!!');
    }

    public function getVoterRegisterSearch(Request $request)
    {
        $election = ElectionSettings::select('id')->where('status', '<=', 1)->first()->id;
        $voter = Voter::where('name', 'ILIKE', '%'.$request['search'].'%')
            ->orWhere('voters_id', 'ILIKE', '%'.$request['search'].'%')
            ->orWhere('mobile_number', 'LIKE', '%'.$request['search'].'%')
            ->where('election_id', $election)
            ->orderBy('name')->limit(10)->get();

        if($voter){
            foreach ($voter as $key => $vote) {
                echo '
                <tr>
                    <td>'. ++$key .'</td>
                    <td>'. $vote->name .'</td>
                    <td>'. $vote->voters_id .'</td>
                    <td>'. $vote->mobile_number .'</td>
                    <td>'. getElectionName($vote->election_id) .'</td>
                    <td>'. getStatus(\App\Models\ElectionSettings::find($vote->election_id)->status) .'</td>
                </tr>
                ';
            }

        }
        else {
            echo '
                <tr>
                    <td colspan="10"><h3>No Data Found</h3></td>
                </tr>
            ';
        }
    }
}
