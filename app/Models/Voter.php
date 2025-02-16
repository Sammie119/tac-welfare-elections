<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

class Voter extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::created(function ($model){
//            dd($model);
            User::create([
                'name' => $model->name,
                'email' => $model->voters_id,
                'password' => Hash::make($model->code),
            ]);

            return $model;
        });

    }
}
