<?php

use App\Models\ElectionSettings;
use App\Models\VotingPosition;
use Illuminate\Support\Facades\Auth;

if (!function_exists("get_logged_in_user_id")) {
    function get_logged_in_user_id(): int
    {
        return Auth::user()->id;
        // return auth()->user()["id"];
    }
}

//if (!function_exists("get_logged_staff_name")) {
//    function get_logged_staff_name($id = null): string
//    {
//        if($id == null){
//            return VWUser::find(Auth::user()->id)->staff_name;
//        }
//
//        return VWUser::find($id)->staff_name;
//    }
//}

if(!function_exists("getStatus")){
    function getStatus($status, $type = null)
    {
        if($type === null) {
            switch ($status) {
                case 0:
                    return "<span class='badge bg-warning rounded-pill p-2' style='font-size: 14px'>Pending</span>";
                case 1:
                    return "<span class='badge bg-primary rounded-pill p-2' style='font-size: 14px'>In Progress</span>";
                case 2:
                    return "<span class='badge bg-success rounded-pill p-2' style='font-size: 14px'>Completed</span>";
                case 3:
                    return "<span class='badge bg-danger rounded-pill p-2' style='font-size: 14px'>Cancelled</span>";
                default:
                    return "Unknown";
            }
        }
        elseif($type === 1) {
            switch ($status) {
                case 0:
                    return "<span class='badge bg-warning rounded-pill p-2' style='font-size: 14px'>Pending</span>";
                case 1:
                    return "<span class='badge bg-success rounded-pill p-2' style='font-size: 14px'>Approved</span>";
                case 2:
                    return "<span class='badge bg-danger rounded-pill p-2' style='font-size: 14px'>Rejected</span>";
                default:
                    return "Unknown";
            }
        }
    }
}

if(!function_exists("intCodeRandom")){
    function intCodeRandom($length = 6)
    {
        $intMin = (10 ** $length) / 10; // 100...
        $intMax = (10 ** $length) - 1;  // 999...

        $codeRandom = mt_rand($intMin, $intMax);

        return $codeRandom;
    }
}

if(!function_exists("getElectionName")){
     function getElectionName($id, $type = null){
         if($type === null) {
             return ElectionSettings::find($id)->name;
         }
         else {
             return VotingPosition::find($id)->position_name;
         }

    }
}
