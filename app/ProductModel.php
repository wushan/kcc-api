<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class ProductModel extends Model
{

    public function getProductCategoryApi()
    {
        $query = DB::table('product_category')->get();
        if ($query) {
            foreach ($query as $row) {
                $langs = $this->getProductCategorylangs($row->PcID);
                $row->langs = $langs;
                $row->sub_category = $this->getProductSubCategorybyPcID($row->PcID);
                if($sub=$row->sub_category){
                    foreach ($sub as $srow){
                        $srow->products = $this->getProductByPcID($srow->PscID);
                    }
                }
            }
        }
        return $query;
    }


    public function getProductApplicationApi()
    {
        $query = DB::table('product_application')->get();
        if ($query) {
            foreach ($query as $row) {
                $langs = $this->getProductApplicationByPaID($row->PaID);
                $row->langs = $langs;
                $row->products =$this->getProductApplicationProductByPaID($row->PaID);
            }
        }
        return $query;
    }


    public function getProductApplicationOrder($id)
    {
        $query = DB::table('product_application_product')->where('paID', $id)->max('order');

        return $query;
    }

    public function getProductSubCategoryOrder($id)
    {
        $query = DB::table('product_sub_category')->where('pcID', $id)->max('order');

        return $query;
    }

    public function getProductStarOrder()
    {
        $query = DB::table('product_star')->max('order');

        return $query;
    }

    public function getProductSubCategorybyPcID($id)
    {
        $query = DB::table('product_sub_category')->where('pcID', $id)->orderBy('order', 'asc')->get();
        if ($query) {
            foreach ($query as $row) {
                $langs = $this->getProductSubCategorylangs($row->PscID);
                $row->langs = $langs;
            }
        }
        return $query;
    }

    public function getProductSubCategorybyPscID($id)
    {
        $query = DB::table('product_sub_category')->where('PscID', $id)->first();
        if ($query) {
            $langs = $this->getProductSubCategorylangs($query->PscID);
            $query->langs = $langs;
        }
        return $query;
    }

    public function getProductByPcID($id)
    {
        $query = DB::table('product')->where('pcID', $id)->orderBy('order','asc')->get();
        if ($query) {
            foreach ($query as $row) {
                $langs = $this->getProductlangs($row->PdID);
                $row->langs = $langs;
            }
        }
        return $query;
    }

    public function getProductByPdID($id)
    {
        $query = DB::table('product')->where('pdID', $id)->first();
        if ($query) {
            $langs = $this->getProductlangs($query->PdID);
            $query->langs = $langs;
        }
        return $query;
    }

    public function getProductCategory()
    {
        $query = DB::table('product_category')->get();
        if ($query) {
            foreach ($query as $row) {
                $langs = $this->getProductCategorylangs($row->PcID);
                $row->langs = $langs;
            }
        }
        return $query;
    }

    public function getProductCategoryByPcID($id)
    {
        $query = DB::table('product_category')->where('PcID', $id)->first();
        if ($query) {
            $langs = $this->getProductCategorylangs($query->PcID);
            $query->langs = $langs;
        }
        return $query;
    }

    public function getProductApplication()
    {
        $application = DB::table('product_application')->get();
        if ($application) {
            foreach ($application as $arow) {
                $langs = $this->getProductApplicationByPaID($arow->PaID);
                $arow->langs = $langs;
            }
        }
        return $application;
    }

    public function getProductApplicationByID($id)
    {
        $application = DB::table('product_application')->where('PaID', $id)->first();
        if ($application) {
                $langs = $this->getProductApplicationByPaID($application->PaID);
            $application->langs = $langs;
        }
        return $application;
    }

    public function getProductApplicationProductByPaID($id)
    {
        $query = DB::table('product_application_product')->where('paID', $id)->orderBy('order', 'asc')->get();
        if ($query) {
            foreach ($query as $row) {
                $langs = $this->getProductApplicationProductlangs($row->PapID);
                $row->langs = $langs;
            }
        }
        return $query;
    }

    public function getProductStar()
    {
        $star = DB::table('product_star')->orderBy('order', 'asc')->get();
        if ($star) {
            foreach ($star as $srow) {
                $langs = $this->getProductStarlangs($srow->PstarID);
                $srow->langs = $langs;
            }
        }
        return $star;
    }

    public function getProductStarByPstarID($id)
    {
        $star = DB::table('product_star')->where('PstarID', $id)->first();
        if ($star) {
            $langs = $this->getProductStarlangs($star->PstarID);
            $star->langs = $langs;
        }
        return $star;
    }

    public function getProductApplicationProductByPapID($id)
    {
        $query = DB::table('product_application_product')->where('PapID', $id)->first();
        if ($query) {
            $langs = $this->getProductApplicationProductlangs($query->PapID);
            $query->langs = $langs;
        }
        return $query;
    }

    public function getApplicationProductCount($id)
    {
        $query = DB::table('product_application_product')->where('paID', $id)->count();

        return $query;
    }

    private function getProductStarlangs($id)
    {
        $lang = DB::table('product_star_lang')->where('PstarID', $id)->get();

        return $lang;
    }

    private function getProductApplicationByPaID($id)
    {
        $lang = DB::table('product_application_lang')->where('paID', $id)->get();

        return $lang;
    }

    private function getProductApplicationProductlangs($id)
    {
        $lang = DB::table('product_application_product_lang')->where('papID', $id)->get();

        return $lang;
    }

    private function getProductCategorylangs($id)
    {
        $lang = DB::table('product_category_lang')->where('pcID', $id)->get();

        return $lang;
    }

    private function getProductlangs($id)
    {
        $lang = DB::table('product_lang')->where('pdID', $id)->get();

        return $lang;
    }

    private function getProductSubCategorylangs($id)
    {
        $lang = DB::table('product_sub_category_lang')->where('PscID', $id)->get();

        return $lang;
    }
}
