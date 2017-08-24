<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class LangModel extends Model
{
    public function getLang()
    {
        $lang = DB::table('web_lang')->get();

        return $lang;
    }
}
