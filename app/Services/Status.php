<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Status
{
    /**
     * @param Request $request
     * @param $table
     */
    public static function toggleStatus(Request  $request, $table)
    {
        if (!empty($request)) {
            if ($request->mode == 'true')
                DB::table($table)->where('id', $request->id)->update(['status' => 'active']);
            else
                DB::table($table)->where('id', $request->id)->update(['status' => 'inactive']);
        }
    }
}
