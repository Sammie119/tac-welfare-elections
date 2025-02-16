<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidate extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::created(function ($model){
//            dd($model);
            BallotPosition::firstOrCreate(
                [
                    'election_id' => $model->election_id,
                    'candidate_id' => $model->id,
                    'voting_position_id' => $model->position,
                ],
                [
                    'position' => 0,
                    'created_by' => get_logged_in_user_id(),
                    'updated_by' => get_logged_in_user_id(),
                ]
            );

            return $model;
        });

    }
}
