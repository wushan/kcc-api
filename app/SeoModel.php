<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class SeoModel extends Model
{
    public function getSeo($item)
    {
        $seo = DB::table('seo')->where('item',$item)->first();
        if($seo){
            $seo->langs=$this->getSeoLang($seo->SeoID);
        }
        return $seo;
    }

    private function getSeoLang($id)
    {
        $lang = DB::table('seo_lang')->where('seoID', $id)->get();

        return $lang;
    }
}
