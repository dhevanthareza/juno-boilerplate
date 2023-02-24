<?php

namespace App\Modules\UserPref\Repositories;

use App\Modules\UserPref\Models\UserPref;

class UserPrefRepository
{
    public static function datatable($per_page = 15)
    {
        $data = UserPref::paginate($per_page);
        return $data;
    }
    public static function get($user_pref_id)
    {
        $user_pref = UserPref::where('id', $user_pref_id)->first();
        return $user_pref;
    }
    public static function create($user_pref)
    {
        $user_pref = UserPref::create($user_pref);
        return $user_pref;
    }

    public static function update($user_pref_id, $user_pref)
    {
        UserPref::where('id', $user_pref_id)->update($user_pref);
        $user_pref = UserPref::where('id', $user_pref_id)->first();
        return $user_pref;
    }

    public static function delete($user_pref_id)
    {
        $delete = UserPref::where('id', $user_pref_id)->delete();
        return $delete;
    }
}
