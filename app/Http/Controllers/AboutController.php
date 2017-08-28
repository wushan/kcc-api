<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class AboutController extends Controller
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

    public function about_research_category()
    {
        $query = App::make('App\AboutModel')->getAboutResearchCategory();

        return view('layout', ['main' => 'about_research_category', 'query' => $query]);
    }

    public function about_research_category_edit(Request $request,$id)
    {
        $lang = App::make('App\LangModel')->getLang();
        $query = App::make('App\AboutModel')->getAboutResearchCategoryByArcID($id);

        $post = $request->all();

        if ($post) {
            if (Input::file('image')) {
                $path = public_path() . '/site-images/about_research_category';
                \File::makeDirectory($path, $mode = 0777, true, true);
                $extension = Input::file('image')->getClientOriginalExtension();
                $fileNmae = uniqid() . '.' . $extension;
                $width=getimagesize(Input::file('image'))[0];
                Input::file('image')->move($path, $fileNmae);
                if($width>1600){
                    Image::make($path . '/' . $fileNmae)->resize(1600, null,function ($constraint) { $constraint->aspectRatio();})->save($path . '/' . $fileNmae);
                }
                $data['image'] = 'site-images/about_research_category/' . $fileNmae;
                if ($query->image && file_exists($query->image)) {
                    unlink($query->image);
                }
                DB::table('about_research_category')
                    ->where('ArcID', $id)
                    ->update($data);
            }
            unset($post['_token']);
            $lang = $post['langs'];
            if ($lang) {
                foreach ($lang as $k => $lrow) {
                    DB::table('about_research_category_lang')->where('ArclID', $lrow['ArclID'])->update($lrow);
                }
            }
            return redirect('/about/about_research_category');
        }

        return view('layout', ['main' => 'about_research_category_edit', 'query' => $query, 'lang' => $lang]);
    }

    public function about_research($id)
    {
        $query = App::make('App\AboutModel')->getAboutResearchByArcID($id);

        return view('layout', ['main' => 'about_research', 'query' => $query, 'id' => $id]);
    }

    public function about_research_add(Request $request, $id)
    {
        $lang = App::make('App\LangModel')->getLang();
        $post = $request->all();

        if ($post) {
            if (Input::file('image')) {
                $path = public_path() . '/site-images/about_research';
                \File::makeDirectory($path, $mode = 0777, true, true);
                $extension = Input::file('image')->getClientOriginalExtension();
                $fileNmae = uniqid() . '.' . $extension;
                $width=getimagesize(Input::file('image'))[0];
                Input::file('image')->move($path, $fileNmae);
                if($width>1600){
                    Image::make($path . '/' . $fileNmae)->resize(1600, null,function ($constraint) { $constraint->aspectRatio();})->save($path . '/' . $fileNmae);
                }
                Image::make($path . '/' . $fileNmae)->resize(320, null,function ($constraint) { $constraint->aspectRatio();})->save($path . '/_' . $fileNmae);
                $data['image'] = 'site-images/about_research/' . $fileNmae;
                $data['image_thumb'] = 'site-images/about_research/_' . $fileNmae;
            }
            unset($post['_token']);
            $lang = $post['langs'];
            $data['arcID'] = $id;
            $getid = DB::table('about_research')->insertGetId($data);
            if ($lang) {
                foreach ($lang as $k => $lrow) {
                    $lang[$k]['arID'] = $getid;
                }
                DB::table('about_research_lang')->insert($lang);
            }
            return redirect('/about/about_research/' . $id);
        }

        return view('layout', ['main' => 'about_research_add', 'id' => $id, 'lang' => $lang]);
    }

    public function about_research_edit(Request $request, $id, $previd)
    {
        $query = App::make('App\AboutModel')->getAboutResearchByArID($id);
        $lang = App::make('App\LangModel')->getLang();
        $post = $request->all();

        if ($post) {
            if (Input::file('image')) {
                $path = public_path() . '/site-images/about_research';
                \File::makeDirectory($path, $mode = 0777, true, true);
                $extension = Input::file('image')->getClientOriginalExtension();
                $fileNmae = uniqid() . '.' . $extension;
                $width=getimagesize(Input::file('image'))[0];
                Input::file('image')->move($path, $fileNmae);
                if($width>1600){
                    Image::make($path . '/' . $fileNmae)->resize(1600, null,function ($constraint) { $constraint->aspectRatio();})->save($path . '/' . $fileNmae);
                }
                Image::make($path . '/' . $fileNmae)->resize(320, null,function ($constraint) { $constraint->aspectRatio();})->save($path . '/_' . $fileNmae);
                $data['image'] = 'site-images/about_research/' . $fileNmae;
                $data['image_thumb'] = 'site-images/about_research/_' . $fileNmae;
                if ($query->image && file_exists($query->image)) {
                    unlink($query->image);
                }
                if ($query->image_thumb && file_exists($query->image_thumb)) {
                    unlink($query->image_thumb);
                }
                DB::table('about_research')
                    ->where('ArID', $id)
                    ->update($data);
            }
            unset($post['_token']);
            $lang = $post['langs'];
            if ($lang) {
                foreach ($lang as $k => $lrow) {
                    DB::table('about_research_lang')->where('ArlID', $lrow['ArlID'])->update($lrow);
                }
            }
            return redirect('/about/about_research/' . $previd);
        }

        return view('layout', ['main' => 'about_research_edit', 'query' => $query, 'id' => $id, 'previd' => $previd, 'lang' => $lang]);

    }

    public function about_research_delete($id, $previd)
    {
        $query = App::make('App\AboutModel')->getAboutResearchByArID($id);
        if ($query) {
            if ($query->image && file_exists($query->image)) {
                unlink($query->image);
            }
            if ($query->image_thumb && file_exists($query->image_thumb)) {
                unlink($query->image_thumb);
            }
            DB::table('about_research')->where('arID', $id)->delete();
            DB::table('about_research_lang')->where('arID', $id)->delete();
        }
        return redirect('/about/about_research/' . $previd);
    }

    public function about_research_seo(Request $request)
    {
        $lang = App::make('App\LangModel')->getLang();
        $seo = App::make('App\SeoModel')->getSeo('about_research');
        $post = $request->all();

        if ($post) {
            unset($post['_token']);
            $seo_lang = $post['langs'];
            if ($seo_lang) {
                foreach ($seo_lang as $k => $lrow) {
                    DB::table('seo_lang')->where('SeolangID', $lrow['SeolangID'])->update($lrow);
                }
            }
            return redirect('/about/about_research_seo');
        }
        return view('layout', ['main' => 'about_research_seo', 'lang' => $lang, 'seo' => $seo]);
    }
}
