<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class AdminModel extends Model
{
    public function getAdmin()
    {
        $admin = DB::table('admin')->first();

        return $admin;
    }
}
