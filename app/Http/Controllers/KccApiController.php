<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class KccApiController
{
    public function getHomeData(Request $request)
    {

        $data = [];
        $post = $request->all();
        $banner = App::make('App\HomeModel')->getHomeBanner();
        $seo = App::make('App\SeoModel')->getSeo('home');

        if ($post) {
            if ($banner) {
                $data['image'] = $banner[rand(0, (count($banner) - 1))]->image;
            }
            if ($seo) {
                $data['keyword'] = $seo->langs[($post['lang'] - 1)]->keyword;
                $data['description'] = $seo->langs[($post['lang'] - 1)]->description;
            }
        }

        return json_encode($data, JSON_UNESCAPED_SLASHES);
    }

    public function getAboutResearchData(Request $request)
    {

        $data = [];
        $post = $request->all();
        $research = App::make('App\AboutModel')->getAboutResearchApi();
        $seo = App::make('App\SeoModel')->getSeo('about_research');

        if ($post) {
            if ($research) {
                foreach ($research as $k => $row) {
                    $data['research'][$row->ArcID]['image'] = $row->image;
                    $data['research'][$row->ArcID]['title'] = $row->langs[($post['lang'] - 1)]->title;
                    $data['research'][$row->ArcID]['products'] = '';
                    if ($products = $row->products) {
                        foreach ($products as $i => $prow) {
                            $data['research'][$prow->arcID]['products'][$i]['image'] = $prow->image;
                            $data['research'][$prow->arcID]['products'][$i]['image_thumb'] = $prow->image_thumb;
                            $data['research'][$prow->arcID]['products'][$i]['langs'] = $prow->langs[($post['lang'] - 1)]->title;
                        }
                    }

                }
            }
            if ($seo) {
                $data['keyword'] = $seo->langs[($post['lang'] - 1)]->keyword;
                $data['description'] = $seo->langs[($post['lang'] - 1)]->description;
            }
        }

        return json_encode($data, JSON_UNESCAPED_SLASHES);
    }

    public function getProduct(Request $request)
    {
        $data = [];
        $post = $request->all();
        $product = App::make('App\ProductModel')->getProductCategoryApi();
        $seo = App::make('App\SeoModel')->getSeo('product_application');

        if ($post) {
            if ($product) {
                foreach ($product as $k=> $row) {
                    $data['product'][$k]['image']=$row->image;
                    $data['product'][$k]['image_thumb']=$row->image_thumb;
                    $data['product'][$k]['file']=$row->file;
                    $data['product'][$k]['title']=$row->langs[($post['lang'] - 1)]->title;
                    $data['product'][$k]['intro']=$row->langs[($post['lang'] - 1)]->intro;
                    $data['product'][$k]['extra_intro']=json_decode($row->langs[($post['lang'] - 1)]->extra_intro,true);
                    $data['product'][$k]['products']='';
                    if($sub_category=$row->sub_category){
                        foreach ($sub_category as $s =>$srow){
                            $data['product'][$k]['sub_category'][$s]['title'] = $srow->langs[($post['lang'] - 1)]->title;
                            if($product=$srow->products){
                                foreach ($product as $p =>$prow){
                                    $data['product'][$k]['sub_category'][$s]['products'][$p]['image'] = $prow->image;
                                    $data['product'][$k]['sub_category'][$s]['products'][$p]['image_thumb'] = $prow->image_thumb;
                                    $data['product'][$k]['sub_category'][$s]['products'][$p]['title'] = $prow->langs[($post['lang'] - 1)]->title;
                                    $data['product'][$k]['sub_category'][$s]['products'][$p]['intro'] = $prow->langs[($post['lang'] - 1)]->intro;
                                }
                            }
                        }
                    }
               }
            }
            if ($seo) {
                $data['keyword'] = $seo->langs[($post['lang'] - 1)]->keyword;
                $data['description'] = $seo->langs[($post['lang'] - 1)]->description;
            }
        }

        return json_encode($data, JSON_UNESCAPED_SLASHES);
    }

    public function getProductApplication(Request $request)
    {
        $data = [];
        $post = $request->all();
        $application = App::make('App\ProductModel')->getProductApplicationApi();
        $seo = App::make('App\SeoModel')->getSeo('product_application');

        if ($post) {
            if ($application) {
                foreach ($application as $k => $row) {
                    $data['application'][$k]['image'] = $row->image;
                    $data['application'][$k]['title'] = $row->langs[($post['lang'] - 1)]->title;
                    if ($product = $row->products) {
                        foreach ($product as $p => $prow) {
                            $data['application'][$k]['products'][$p]['order'] = $prow->order;
                            $data['application'][$k]['products'][$p]['image'] = $prow->image;
                            $data['application'][$k]['products'][$p]['image_thumb'] = $prow->image_thumb;
                            $data['application'][$k]['products'][$p]['title'] = $prow->langs[($post['lang'] - 1)]->title;
                        }
                    }
                };

            }
            if ($seo) {
                $data['keyword'] = $seo->langs[($post['lang'] - 1)]->keyword;
                $data['description'] = $seo->langs[($post['lang'] - 1)]->description;
            }
        }
        return json_encode($data, JSON_UNESCAPED_SLASHES);
    }

    public function getProductStar(Request $request)
    {
        $data = [];
        $post = $request->all();
        $star = App::make('App\ProductModel')->getProductStar();
        $seo = App::make('App\SeoModel')->getSeo('product_star');

        if ($post) {
            if ($star) {
                foreach ($star as $k => $row) {
                    $data['products'][$k]['order'] = $row->order;
                    $data['products'][$k]['image'] = $row->image;
                    $data['products'][$k]['image_thumb'] = $row->image_thumb;
                    $data['products'][$k]['intro'] = $row->langs[($post['lang'] - 1)]->intro;
                }
            }
            if ($seo) {
                $data['keyword'] = $seo->langs[($post['lang'] - 1)]->keyword;
                $data['description'] = $seo->langs[($post['lang'] - 1)]->description;
            }
        }

        return json_encode($data, JSON_UNESCAPED_SLASHES);
    }

    public function getNews(Request $request)
    {
        $data = [];
        $post = $request->all();
        $news = App::make('App\NewsModel')->getNews();
        $seo = App::make('App\SeoModel')->getSeo('news');

        if ($post) {
            if ($news) {
                foreach ($news as $k => $row) {
                    $data['news'][$k]['id'] = $row->NewsID;
                    $data['news'][$k]['date'] = $row->date;
                    $data['news'][$k]['image'] = $row->image;
                    $data['news'][$k]['title'] = $row->langs[($post['lang'] - 1)]->title;
                    $data['news'][$k]['intro'] = $row->langs[($post['lang'] - 1)]->intro;
                    $data['news'][$k]['content'] = $row->langs[($post['lang'] - 1)]->content;
                }
            }
            if ($seo) {
                $data['keyword'] = $seo->langs[($post['lang'] - 1)]->keyword;
                $data['description'] = $seo->langs[($post['lang'] - 1)]->description;
            }
        }

        return json_encode($data, JSON_UNESCAPED_SLASHES);
    }
}
