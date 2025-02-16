<?php

namespace App\Imports;

use App\Models\ElectionSettings;
use App\Models\Voter;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class VoterImport implements ToModel,WithHeadingRow, WithValidation
{
    protected function getElectionID($name){
//        dd(ElectionSettings::where('name', $name)->first()->id);
        return ElectionSettings::where('name', $name)->first()->id;

    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Voter([
            'election_id' => $this->getElectionID($row['election_id']),
            'name' => $row['name'],
            'voters_id' => $row['voters_id'],
            'mobile_number' => $row['mobile_number'],
            'code' => intCodeRandom(),
            'created_by' => get_logged_in_user_id(),
            'updated_by' => get_logged_in_user_id(),
        ]);
    }

    public function rules(): array
    {
        return [
            'election_id' => 'required',
            'name' => 'required',
            'voters_id' => 'required',
            'mobile_number' => 'required',
        ];
    }
}
