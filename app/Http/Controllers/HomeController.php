<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Session::get('login')==null)
            {
                return redirect('/');
            }else{
                return $next($request);
            }
        });
    }

    public function home_banner()
    {
        $banner = App::make('App\HomeModel')->getHomeBanner();
        $bannerCount = App::make('App\HomeModel')->getBannerCount();
        return view('layout', ['main' => 'home_banner','banner'=>$banner,'count'=>$bannerCount]);
    }

    public function home_banner_add(Request $request)
    {
        $bannerCount = App::make('App\HomeModel')->getBannerCount();
        if($bannerCount>=5){
            return redirect('home/home_banner');
        }
        $post = $request->all();
        if ($post) {
            if (Input::file('image')) {
                $path = public_path() . '/site-images/home_banner';
                \File::makeDirectory($path, $mode = 0777, true, true);
                $extension = Input::file('image')->getClientOriginalExtension();
                $fileNmae = uniqid() . '.' . $extension;
                $width=getimagesize(Input::file('image'))[0];
                Input::file('image')->move($path, $fileNmae);
                if($width>1600){
                  Image::make($path . '/' . $fileNmae)->resize(1600, null,function ($constraint) { $constraint->aspectRatio();})->save($path . '/' . $fileNmae);
                }
                $data['image'] = 'site-images/home_banner/' . $fileNmae;
                DB::table('home_banner')->insert($data);
            }
            return redirect('home/home_banner');
        }

        return view('layout', ['main' => 'home_banner_add']);
    }


    public function home_banner_edit(Request $request, $id)
    {
        $post = $request->all();
        $banner = App::make('App\HomeModel')->getHomeBannerByBannerID($id);
        if ($post) {
            if (Input::file('image')) {
                $path = public_path() . '/site-images/home_banner';
                \File::makeDirectory($path, $mode = 0777, true, true);
                $extension = Input::file('image')->getClientOriginalExtension();
                $fileNmae = uniqid() . '.' . $extension;
                $width=getimagesize(Input::file('image'))[0];
                Input::file('image')->move($path, $fileNmae);
                if($width>1600){
                    Image::make($path . '/' . $fileNmae)->resize(1600, null,function ($constraint) { $constraint->aspectRatio();})->save($path . '/' . $fileNmae);
                }
                $data['image'] = 'site-images/home_banner/' . $fileNmae;
                if ($banner->image && file_exists($banner->image)) {
                    unlink($banner->image);
                }
                DB::table('home_banner')
                    ->where('BannerID', $id)
                    ->update($data);
            }
            return redirect('home/home_banner');
        }
        return view('layout', ['main' => 'home_banner_edit','banner'=>$banner]);
    }

    public function home_banner_delete($id)
    {
        $banner = App::make('App\HomeModel')->getHomeBannerByBannerID($id);
        if($banner){
            if($banner->image && file_exists($banner->image) ){
                unlink($banner->image);
            }
            DB::table('home_banner')->where('BannerID', $id)->delete();
        }
        return redirect('home/home_banner');
    }

    public function home_seo(Request $request)
    {
        $lang = App::make('App\LangModel')->getLang();
        $seo = App::make('App\SeoModel')->getSeo('home');
        $post = $request->all();
        if ($post) {
            unset($post['_token']);
            $seo_lang = $post['langs'];
            if ($seo_lang) {
                foreach ($seo_lang as $k => $lrow) {
                    DB::table('seo_lang')->where('SeolangID', $lrow['SeolangID'])->update($lrow);
                }
            }
            return redirect('/home/home_seo');
        }
        return view('layout', ['main' => 'home_seo', 'lang' => $lang, 'seo' => $seo]);
    }
}
