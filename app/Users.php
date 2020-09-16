<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;

class Users extends Model
{
    public static function getAllUsers(){

        $all_users =  DB::table('users')->get();
        return $all_users;
    }

    public static function getAllUsersPositions(){

        $all_users_positions = DB::table('user_positions')->get();
        return $all_users_positions;
    }

    public static function getAllUsersByUserID($user_id){

       // $all_users =DB::select("SELECT * FROM `users` WHERE `user_id` = '{$user_id}'")
                      //  ->limit(1);

         $all_users = DB::table('users')
             ->where('user_id', $user_id)
             ->get();

        return $all_users;
    }

    public static function getAllUsersPositionsByUserID($user_id){

//        $all_users =DB::select("SELECT * FROM `user_positions` WHERE `user_id` = '{$user_id}'")
//                     ->limit(1);

        $all_users = DB::table('user_positions')
            ->where('user_id', $user_id)
            ->get();

        //   $all_users = DB::table('users')->find($user_id);
        return $all_users;
    }
}
