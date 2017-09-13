<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class NewsModel extends Model
{
    public function getNews()
    {
        $news = DB::table('news')->orderby('date','desc')->get();
        if ($news) {
            foreach ($news as $nrow) {
                $langs = $this->getNewsLang($nrow->NewsID);
                $nrow->langs = $langs;
            }
        }
        return $news;
    }

    public function getNewsbyNewsID($id)
    {
        $news = DB::table('news')->where('NewsID', $id)->first();
        if ($news) {
            $langs = $this->getNewsLang($news->NewsID);
            $news->langs = $langs;
        }
        return $news;
    }

    public function getLang()
    {
        $lang = DB::table('web_lang')->get();

        return $lang;
    }

    private function getNewsLang($id)
    {
        $lang = DB::table('news_lang')->where('newsID', $id)->get();

        return $lang;
    }
}
