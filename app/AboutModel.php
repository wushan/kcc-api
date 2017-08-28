<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class AboutModel extends Model
{

    public function getAboutResearchApi()
    {
        $query = DB::table('about_research_category')->get();
        if ($query) {
            foreach ($query as $row) {
                $langs = $this->getAboutResearchCategoryLang($row->ArcID);
                $row->langs = $langs;
                $row->products = $this->getAboutResearchByArcID($row->ArcID);
            }
        }
        return $query;
    }

    public function getAboutResearchCategory()
    {
        $query = DB::table('about_research_category')->get();
        if ($query) {
            foreach ($query as $row) {
                $langs = $this->getAboutResearchCategoryLang($row->ArcID);
                $row->langs = $langs;
            }
        }
        return $query;
    }

    public function getAboutResearchCategoryByArcID($id)
    {
        $query = DB::table('about_research_category')->where('ArcID', $id)->first();
        if ($query) {
                $langs = $this->getAboutResearchCategoryLang($query->ArcID);
                $query->langs = $langs;
        }
        return $query;
    }

    public function getAboutResearchByArcID($id)
    {
        $query = DB::table('about_research')->where('arcID', $id)->get();
        if ($query) {
            foreach ($query as $row) {
                $langs = $this->getAboutResearchLang($row->ArID);
                $row->langs = $langs;
            }
        }
        return $query;
    }

    public function getAboutResearchByArID($id)
    {
        $query = DB::table('about_research')->where('arID', $id)->first();
        if ($query) {
                $langs = $this->getAboutResearchLang($query->ArID);
                $query->langs = $langs;
        }
        return $query;
    }

    public function getAboutResearchLang($id)
    {
        $lang = DB::table('about_research_lang')->where('arID', $id)->get();

        return $lang;
    }

    private function getAboutResearchCategoryLang($id)
    {
        $lang = DB::table('about_research_category_lang')->where('arcID', $id)->get();

        return $lang;
    }
}
