<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class HomeModel extends Model
{
    public function getHomeBanner()
    {
        $home_banner = DB::table('home_banner')->get();

        return $home_banner;
    }

    public function getHomeBannerByBannerID($id)
    {
        $home_banner = DB::table('home_banner')->where('BannerID', $id)->first();

        return $home_banner;
    }

    public function getBannerCount()
    {
        $home_banner = DB::table('home_banner')->count();

        return $home_banner;
    }
}
