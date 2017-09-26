<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class NewsController extends Controller
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

    public function index()
    {
        $newData = App::make('App\NewsModel')->getNews();
        return view('layout',['main'=>'news','news'=>$newData]);
    }

    public function add()
    {
        $lang = App::make('App\NewsModel')->getLang();
        return view('layout',['main'=>'news_add','lang'=>$lang]);
    }

    public function edit($id)
    {
        $newData = App::make('App\NewsModel')->getNewsbyNewsID($id);
        $lang = App::make('App\NewsModel')->getLang();
        return view('layout',['main'=>'news_edit','lang'=>$lang,'news'=>$newData]);
    }

    public function news_seo(Request $request)
    {
        $lang = App::make('App\NewsModel')->getLang();
        $seo = App::make('App\SeoModel')->getSeo('news');
        $post=$request->all();
        if($post){
            unset($post['_token']);
            $seo_lang=$post['langs'];
            if($seo_lang){
                foreach ($seo_lang as $k=> $lrow){
                    DB::table('seo_lang')->where('SeolangID', $lrow['SeolangID'])->update($lrow);
                }

            }
            return redirect('news/news_seo');
        }
        return view('layout',['main'=>'news_seo','lang'=>$lang,'seo'=>$seo]);
    }

    public function insert(Request $request)
    {
        $post=$request->all();
        if ($post){
            if(Input::file('image')){
                $path = public_path().'/site-images/news';
                \File::makeDirectory($path, $mode = 0777, true, true);
                $extension = Input::file('image')->getClientOriginalExtension();
                $fileNmae=uniqid().'.'.$extension;
                $width=getimagesize(Input::file('image'))[0];
                Input::file('image')->move($path, $fileNmae);
                if($width>1600){
                    Image::make($path . '/' . $fileNmae)->resize(1600, null,function ($constraint) { $constraint->aspectRatio();})->save($path . '/' . $fileNmae);
                }
                $data['image']='site-images/news/'.$fileNmae;
            }
            unset($post['_token']);
            $lang=$post['langs'];
            $data['date']=$post['date'];
            $data['exhibition_date']=$post['exhibition_date'];
            $id = DB::table('news')->insertGetId($data);
            if($lang){
                foreach ($lang as $k=> $lrow){
                    $lang[$k]['newsID']=$id;
                }
                DB::table('news_lang')->insert($lang);
            }
        }
        return redirect('news');
    }

    public function update(Request $request,$id)
    {
        $post=$request->all();
        $news = App::make('App\NewsModel')->getNewsbyNewsID($id);
        if ($post){
            if(Input::file('image')){
                $path = public_path().'/site-images/news';
                \File::makeDirectory($path, $mode = 0777, true, true);
                $extension = Input::file('image')->getClientOriginalExtension();
                $fileNmae=uniqid().'.'.$extension;
                $width=getimagesize(Input::file('image'))[0];
                Input::file('image')->move($path, $fileNmae);
                if($width>1600){
                    Image::make($path . '/' . $fileNmae)->resize(1600, null,function ($constraint) { $constraint->aspectRatio();})->save($path . '/' . $fileNmae);
                }
                $data['image']='site-images/news/'.$fileNmae;
                if($news->image && file_exists($news->image) ){
                    unlink($news->image);
                }
            }
            unset($post['_token']);
            $lang=$post['langs'];
            $data['date']=$post['date'];
            $data['exhibition_date']=$post['exhibition_date'];
            DB::table('news')
                ->where('NewsID', $id)
                ->update($data);
            if($lang){
                foreach ($lang as $k=> $lrow){
                    $lang[$k]['newsID']=$id;
                    DB::table('news_lang')->where('NewslangID', $lrow['NewslangID'])->update($lrow);
                }

            }
        }
        return redirect('news');
    }

    public function delete($id)
    {
        $news = App::make('App\NewsModel')->getNewsbyNewsID($id);
        if($news){
            if($news->image && file_exists($news->image) ){
                unlink($news->image);
            }
            DB::table('news')->where('NewsID', $id)->delete();
            DB::table('news_lang')->where('NewsID', $id)->delete();
        }
        return redirect('news');
    }
}
