<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Session::get('login') == null) {
                return redirect('/');
            } else {
                return $next($request);
            }
        });
    }

    public function index()
    {
        $query = App::make('App\ProductModel')->getProductCategory();

        return view('layout', ['main' => 'product_category', 'query' => $query]);
    }

    public function product_category_add(Request $request)
    {
        $lang = App::make('App\LangModel')->getLang();
        $post = $request->all();
        if ($post) {
            if (Input::file('image')) {
                $path = public_path() . '/site-images/product_category';
                \File::makeDirectory($path, $mode = 0777, true, true);
                $extension = Input::file('image')->getClientOriginalExtension();
                $fileNmae = uniqid() . '.' . $extension;
                $width = getimagesize(Input::file('image'))[0];
                Input::file('image')->move($path, $fileNmae);
                if ($width > 1600) {
                    Image::make($path . '/' . $fileNmae)->resize(1600, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path . '/' . $fileNmae);
                }
                Image::make($path . '/' . $fileNmae)->resize(320, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path . '/_' . $fileNmae);
                $data['image'] = 'site-images/product_category/' . $fileNmae;
                $data['image_thumb'] = 'site-images/product_category/_' . $fileNmae;
            }
            if (Input::file('file')) {
                $path = public_path() . '/site-images/product_category';
                \File::makeDirectory($path, $mode = 0777, true, true);
                $extension = Input::file('file')->getClientOriginalExtension();
                $fileNmae = uniqid() . '.' . $extension;
                Input::file('file')->move($path, $fileNmae);
                $data['file'] = 'site-images/product_category/' . $fileNmae;
                $data['file_name'] = Input::file('file')->getClientOriginalName();
            }
            unset($post['_token']);
            $lang = $post['langs'];
            $data['type'] = $post['type'];
            $id = DB::table('product_category')->insertGetId($data);
            if ($lang) {
                foreach ($lang as $k => $lrow) {
                    $extra_intro = '';
                    if (!empty($lrow['extra_intro']) && $post['type'] == 1) {
                        foreach ($lrow['extra_intro'] as $i => $image) {
                            if ($img = Input::file('langs')[$k]['extra_intro'][$i]) {
                                $path = public_path() . '/site-images/product_category';
                                \File::makeDirectory($path, $mode = 0777, true, true);
                                $extension = $img->getClientOriginalExtension();
                                $fileNmae = uniqid() . '.' . $extension;
                                $width = getimagesize($img)[0];
                                $img->move($path, $fileNmae);
                                if ($width > 1600) {
                                    Image::make($path . '/' . $fileNmae)->resize(1600, null, function ($constraint) {
                                        $constraint->aspectRatio();
                                    })->save($path . '/' . $fileNmae);
                                }
                                sleep(1);
                                $extra_intro['type'] = $post['type'];
                                $extra_intro['image'][] = 'site-images/product_category/' . $fileNmae;
                            }
                        }
                    }
                    if (!empty($lrow['extra_intro']) && $post['type'] == 2) {
                        if ($img = Input::file('langs')[$k]['extra_intro']['image']) {
                            $path = public_path() . '/site-images/product_category';
                            \File::makeDirectory($path, $mode = 0777, true, true);
                            $extension = $img->getClientOriginalExtension();
                            $fileNmae = uniqid() . '.' . $extension;
                            $width = getimagesize($img)[0];
                            $img->move($path, $fileNmae);
                            if ($width > 1600) {
                                Image::make($path . '/' . $fileNmae)->resize(1600, null, function ($constraint) {
                                    $constraint->aspectRatio();
                                })->save($path . '/' . $fileNmae);
                            }
                            sleep(1);
                            $extra_intro = [
                                'type' => $post['type'],
                                'image' => 'site-images/product_category/' . $fileNmae,
                                'content' => $lrow['extra_intro']['content']
                            ];
                        }
                    }
                    if (!empty($lrow['extra_intro']) && $post['type'] == 3) {
                        $extra_intro['type'] = $post['type'];
                        $extra_intro['content'] = $lrow['extra_intro']['content'];
                    }
                    $lang[$k]['pcID'] = $id;
                    $lang[$k]['extra_intro'] = json_encode($extra_intro);
                }
                DB::table('product_category_lang')->insert($lang);
            }
            return redirect('/product');
        }

        return view('layout', ['main' => 'product_category_add', 'lang' => $lang]);
    }

    public function product_category_edit(Request $request, $PcID)
    {
        $lang = App::make('App\LangModel')->getLang();
        $query = App::make('App\ProductModel')->getProductCategoryByPcID($PcID);
        $post = $request->all();

        if ($post) {
            if (Input::file('image')) {
                $path = public_path() . '/site-images/product_category';
                \File::makeDirectory($path, $mode = 0777, true, true);
                $extension = Input::file('image')->getClientOriginalExtension();
                $fileNmae = uniqid() . '.' . $extension;
                if ($query->image && file_exists($query->image)) {
                    unlink($query->image);
                }
                if ($query->image_thumb && file_exists($query->image_thumb)) {
                    unlink($query->image_thumb);
                }
                $width = getimagesize(Input::file('image'))[0];
                Input::file('image')->move($path, $fileNmae);
                if ($width > 800) {
                    Image::make($path . '/' . $fileNmae)->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path . '/' . $fileNmae);
                }
                Image::make($path . '/' . $fileNmae)->resize(320, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path . '/_' . $fileNmae);
                $data['image'] = 'site-images/product_category/' . $fileNmae;
                $data['image_thumb'] = 'site-images/product_category/_' . $fileNmae;
            }
            if (Input::file('file')) {
                $path = public_path() . '/site-images/product_category';
                \File::makeDirectory($path, $mode = 0777, true, true);
                $extension = Input::file('file')->getClientOriginalExtension();
                $fileNmae = uniqid() . '.' . $extension;
                if ($query->file && file_exists($query->file)) {
                    unlink($query->file);
                }
                Input::file('file')->move($path, $fileNmae);
                $data['file'] = 'site-images/product_category/' . $fileNmae;
                $data['file_name'] = Input::file('file')->getClientOriginalName();
            }
            unset($post['_token']);
            $lang = $post['langs'];
            $data['type'] = $post['type'];
            DB::table('product_category')->where('PcID', $PcID)->update($data);
            if ($lang) {
                foreach ($lang as $k => $lrow) {
                    $extra_intro = '';
                    $extra_image = '';
                    $oldImg = isset(json_decode($query->langs[$k - 1]->extra_image)->image) ? json_decode($query->langs[$k - 1]->extra_image)->image : '';
                    $Limg = (isset($oldImg[0])) ? $oldImg[0] : '';
                    $Rimg = (isset($oldImg[1])) ? $oldImg[1] : '';
                    if ($post['type'] == 0) {
                        $extra_intro['type'] = $post['type'];
                        $extra_image['image'] = '';
                    }
                    if (!empty($lrow['extra_image']) && $post['type'] == 1) {
                        foreach ($lrow['extra_image'] as $i => $image) {
                            if (isset($image) && $i == 'Limage') {
                                if (Input::file('langs')[$k]['extra_image'][$i]) {
                                    $path = public_path() . '/site-images/product_category';
                                    \File::makeDirectory($path, $mode = 0777, true, true);
                                    $extension = $image->getClientOriginalExtension();
                                    $fileNmae = uniqid() . '.' . $extension;
//                                    if ($oldImg[$k] && file_exists($oldImg[$k])) {
//                                        unlink($oldImg[$k]);
//                                    }
                                    $width = getimagesize($image)[0];
                                    $image->move($path, $fileNmae);
                                    if ($width > 1600) {
                                        Image::make($path . '/' . $fileNmae)->resize(1600, null, function ($constraint) {
                                            $constraint->aspectRatio();
                                        })->save($path . '/' . $fileNmae);
                                    }
                                    sleep(1);
                                    $extra_intro['type'] = $post['type'];
                                    $Limg = 'site-images/product_category/' . $fileNmae;
                                    $extra_image['image'][] = $Limg;
                                }
                            }
                            if (isset($image) && $i == 'Rimage') {
                                if (Input::file('langs')[$k]['extra_image'][$i]) {
                                    $path = public_path() . '/site-images/product_category';
                                    \File::makeDirectory($path, $mode = 0777, true, true);
                                    $extension = $image->getClientOriginalExtension();
                                    $fileNmae = uniqid() . '.' . $extension;
//                                    if ($oldImg[$k] && file_exists($oldImg[$k])) {
//                                        unlink($oldImg[$k]);
//                                    }
                                    $width = getimagesize($image)[0];
                                    $image->move($path, $fileNmae);
                                    if ($width > 1600) {
                                        Image::make($path . '/' . $fileNmae)->resize(1600, null, function ($constraint) {
                                            $constraint->aspectRatio();
                                        })->save($path . '/' . $fileNmae);
                                    }
                                    sleep(1);
                                    $extra_intro['type'] = $post['type'];
                                    $Rimg = 'site-images/product_category/' . $fileNmae;
                                    $extra_image['image'][] = $Rimg;
                                }
                            }
                        }
                        $extra_image['image'] = [$Limg, $Rimg];
                    }
                    if (!empty($lrow['extra_intro']) && $post['type'] == 2) {
                        $imgpath = '';
                        $oldImg = isset(json_decode($query->langs[$k - 1]->extra_image)->image) ? json_decode($query->langs[$k - 1]->extra_image)->image : '';
                        if (isset(Input::file('langs')[$k]['extra_image']['image'])) {
                            if ($img = Input::file('langs')[$k]['extra_image']['image']) {
                                $path = public_path() . '/site-images/product_category';
                                \File::makeDirectory($path, $mode = 0777, true, true);
                                $extension = $img->getClientOriginalExtension();
                                $fileNmae = uniqid() . '.' . $extension;
                                if ($oldImg && file_exists($oldImg)) {
                                    unlink($oldImg);
                                }
                                $width = getimagesize($img)[0];
                                $img->move($path, $fileNmae);
                                if ($width > 1600) {
                                    Image::make($path . '/' . $fileNmae)->resize(1600, null, function ($constraint) {
                                        $constraint->aspectRatio();
                                    })->save($path . '/' . $fileNmae);
                                }
                                sleep(1);
                                $imgpath = 'site-images/product_category/' . $fileNmae;
                            }
                        }
                        $extra_intro = [
                            'type' => $post['type'],
                            'content' => $lrow['extra_intro']['content']
                        ];
                        $extra_image['image'] = $imgpath;
                    }
                    if (!empty($lrow['extra_intro']) && $post['type'] == 3) {
                        $extra_intro['type'] = $post['type'];
                        $extra_intro['content'] = $lrow['extra_intro']['content'];
                    }
                    $lang[$k]['extra_intro'] = json_encode($extra_intro);
                    if (isset($lrow['extra_image']) || $post['type'] == 0) {
                        $lang[$k]['extra_image'] = json_encode($extra_image);
                    }

                }
                if ($lang) {
                    foreach ($lang as $k => $lrow) {
                        DB::table('product_category_lang')->where('PclID', $lrow['PclID'])->update($lrow);
                    }

                }
            }
            return redirect('/product');
        }

        return view('layout', ['main' => 'product_category_edit', 'lang' => $lang, 'query' => $query]);
    }

    public function product_category_delete($id)
    {
        $query = App::make('App\ProductModel')->getProductCategoryByPcID($id);
        if ($query) {
            if ($query->image && file_exists($query->image)) {
                unlink($query->image);
            }
            if ($query->image_thumb && file_exists($query->image_thumb)) {
                unlink($query->image_thumb);
            }
            if ($query->file && file_exists($query->file)) {
                unlink($query->file);
            }
            if ($query->langs) {
                foreach ($query->langs as $row) {
                    $del = $row->extra_intro;
                    if (isset($del->image)) {
                        foreach (json_decode($del)->image as $drow) {
                            if ($drow && file_exists($drow)) {
                                unlink($drow);
                            }
                        }
                    }
                }
            }
            DB::table('product_category')->where('PcID', $id)->delete();
            DB::table('product_category_lang')->where('PcID', $id)->delete();
        }
        return redirect('/product');
    }

    public function product_sub_category(Request $request, $previd)
    {
        $query = App::make('App\ProductModel')->getProductSubCategorybyPcID($previd);
        $post = $request->all();

        if (isset($post['order'])) {
            unset($post['_token']);
            foreach ($post['order'] as $k => $row) {
                DB::table('product_sub_category')->where('PscID', $row)->update(['order' => $k+1]);
            }
            return redirect('/product/product_sub_category/' . $previd);
        }

        return view('layout', ['main' => 'product_sub_category', 'query' => $query, 'previd' => $previd]);
    }

    public function product_sub_category_add(Request $request, $previd)
    {
        $lang = App::make('App\LangModel')->getLang();
        $order = App::make('App\ProductModel')->getProductSubCategoryOrder($previd);
        $post = $request->all();

        if ($post) {
            if (Input::file('file')) {
                $path = public_path() . '/site-images/product_sub_category';
                \File::makeDirectory($path, $mode = 0777, true, true);
                $extension = Input::file('file')->getClientOriginalExtension();
                $fileNmae = uniqid() . '.' . $extension;
                Input::file('file')->move($path, $fileNmae);
                $data['file'] = 'site-images/product_sub_category/' . $fileNmae;
                $data['file_name'] = Input::file('file')->getClientOriginalName();
            }
            unset($post['_token']);
            $data['pcID'] = $previd;
            $data['order'] = $order + 1;
            $id = DB::table('product_sub_category')->insertGetId($data);
            $postlang = $post['langs'];
            if ($postlang) {
                foreach ($postlang as $k => $lrow) {
                    $postlang[$k]['pscID'] = $id;
                }
                DB::table('product_sub_category_lang')->insert($postlang);

            }
            return redirect('/product/product_sub_category/' . $previd);
        }
        return view('layout', ['main' => 'product_sub_category_add', 'lang' => $lang, 'previd' => $previd]);
    }

    public function product_sub_category_edit(Request $request, $id, $previd)
    {
        $lang = App::make('App\LangModel')->getLang();
        $query = App::make('App\ProductModel')->getProductSubCategorybyPscID($id);
        $post = $request->all();

        if ($post) {
            if (Input::file('file')) {
                $path = public_path() . '/site-images/product_sub_category';
                \File::makeDirectory($path, $mode = 0777, true, true);
                $extension = Input::file('file')->getClientOriginalExtension();
                $fileNmae = uniqid() . '.' . $extension;
                if ($query->file && file_exists($query->file)) {
                    unlink($query->file);
                }
                Input::file('file')->move($path, $fileNmae);
                $data['file'] = 'site-images/product_sub_category/' . $fileNmae;
                $data['file_name'] = Input::file('file')->getClientOriginalName();
                DB::table('product_sub_category')->where('PscID', $id)->update($data);
            }
            unset($post['_token']);
            $postLangs = $post['langs'];
            if ($postLangs) {
                foreach ($postLangs as $k => $lrow) {
                    DB::table('product_sub_category_lang')->where('PsclID', $lrow['PsclID'])->update($lrow);
                }
            }
            return redirect('/product/product_sub_category/' . $previd);
        }
        return view('layout', ['main' => 'product_sub_category_edit', 'lang' => $lang, 'query' => $query, 'previd' => $previd]);
    }


    public function product_sub_category_delete($id, $previd)
    {
        $query = App::make('App\ProductModel')->getProductSubCategorybyPscID($id);
        if ($query) {
            if ($query->file && file_exists($query->file)) {
                unlink($query->file);
            }
            DB::table('product_sub_category')->where('PscID', $id)->delete();
            DB::table('product_sub_category_lang')->where('PscID', $id)->delete();
        }
        return redirect('/product/product_sub_category/' . $previd);
    }

    public function product_list(Request $request, $subid, $previd)
    {
        $post = $request->all();
        $query = App::make('App\ProductModel')->getProductByPcID($subid);

        if (isset($post['order'])) {
            unset($post['_token']);
            foreach ($post['order'] as $k => $row) {
                DB::table('product')->where('PdID', $row)->update(['order' => $k+1]);
            }
            return redirect('/product/product_list/' . $subid . '/' . $previd);
        }

        if ($post) {
            if (Input::file('image')) {
                $path = public_path() . '/site-images/product';
                $order = App::make('App\ProductModel')->getProductOrder($subid);
                \File::makeDirectory($path, $mode = 0777, true, true);
                $extension = Input::file('image')->getClientOriginalExtension();
                $fileNmae = uniqid() . '.' . $extension;
                $width = getimagesize(Input::file('image'))[0];
                Input::file('image')->move($path, $fileNmae);
                if ($width > 960) {
                    Image::make($path . '/' . $fileNmae)->resize(960, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path . '/' . $fileNmae);
                }
                Image::make($path . '/' . $fileNmae)->resize(320, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path . '/_' . $fileNmae);
                $data['image'] = 'site-images/product/' . $fileNmae;
                $data['image_thumb'] = 'site-images/product/_' . $fileNmae;
                $data['pcID'] = $subid;
                $data['order'] = $order+1;
                $id = DB::table('product')->insertGetId($data);
                for ($i = 0; $i <= 1; $i++) {
                    DB::table('product_lang')->insert(['PdID' => $id]);
                }
            }
        }
        return view('layout', ['main' => 'product_list', 'subid' => $subid, 'previd' => $previd, 'query' => $query]);
    }

    public function product_edit(Request $request, $id, $subid, $previd)
    {
        $lang = App::make('App\LangModel')->getLang();
        $query = App::make('App\ProductModel')->getProductByPdID($id);
        $post = $request->all();

        if ($post) {
            unset($post['_token']);
            $postLangs = $post['langs'];
            if ($postLangs) {
                foreach ($postLangs as $k => $lrow) {
                    DB::table('product_lang')->where('PdlID', $lrow['PdlID'])->update($lrow);
                }
            }
            return redirect('/product/product_list/' . $subid . '/' . $previd);
        }
        return view('layout', ['main' => 'product_edit', 'lang' => $lang, 'query' => $query, 'subid' => $subid, 'previd' => $previd]);
    }

    public function product_delete($id, $subid, $previd)
    {
        $query = App::make('App\ProductModel')->getProductByPdID($id);
        if ($query) {
            if ($query->image && file_exists($query->image)) {
                unlink($query->image);
            }
            if ($query->image_thumb && file_exists($query->image_thumb)) {
                unlink($query->image_thumb);
            }
            DB::table('product')->where('PdID', $id)->delete();
            DB::table('product_lang')->where('PdID', $id)->delete();
        }
        return redirect('/product/product_list/' . $subid . '/' . $previd);
    }

    public function product_star(Request $request)
    {
        $post = $request->all();
        $star = App::make('App\ProductModel')->getProductStar();
        $order = App::make('App\ProductModel')->getProductStarOrder();
        if ($post) {
            if (Input::file('image')) {
                $path = public_path() . '/site-images/product_star';
                \File::makeDirectory($path, $mode = 0777, true, true);
                $extension = Input::file('image')->getClientOriginalExtension();
                $fileNmae = uniqid() . '.' . $extension;
                $width = getimagesize(Input::file('image'))[0];
                Input::file('image')->move($path, $fileNmae);
                if ($width > 1600) {
                    Image::make($path . '/' . $fileNmae)->resize(1600, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path . '/' . $fileNmae);
                }
                Image::make($path . '/' . $fileNmae)->resize(320, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path . '/_' . $fileNmae);
                $data['image'] = 'site-images/product_star/' . $fileNmae;
                $data['image_thumb'] = 'site-images/product_star/_' . $fileNmae;
                $data['order'] = $order + 1;
                $id = DB::table('product_star')->insertGetId($data);
                for ($i = 0; $i <= 1; $i++) {
                    DB::table('product_star_lang')->insert(['pstarID' => $id]);
                }
            }
            if (isset($post['order'])) {
                unset($post['_token']);
                foreach ($post['order'] as $k => $row) {
                    DB::table('product_star')->where('PstarID', $row)->update(['order' => $k+1]);
                }
            }
            return redirect('/product/product_star');
        }
        return view('layout', ['main' => 'product_star', 'star' => $star]);
    }

    public function product_star_edit(Request $request, $id)
    {
        $lang = App::make('App\LangModel')->getLang();
        $star = App::make('App\ProductModel')->getProductStarByPstarID($id);
        $post = $request->all();
        if ($post) {
            unset($post['_token']);
            $postLangs = $post['langs'];
            if ($postLangs) {
                foreach ($postLangs as $k => $lrow) {
                    DB::table('product_star_lang')->where('PstarlangID', $lrow['PstarlangID'])->update($lrow);
                }
            }
            return redirect('/product/product_star');
        }
        return view('layout', ['main' => 'product_star_edit', 'lang' => $lang, 'star' => $star]);
    }

    public function product_star_delete($id)
    {
        $star = App::make('App\ProductModel')->getProductStarByPstarID($id);
        if ($star) {
            if ($star->image && file_exists($star->image)) {
                unlink($star->image);
            }
            if ($star->image_thumb && file_exists($star->image_thumb)) {
                unlink($star->image_thumb);
            }
            DB::table('product_star')->where('PstarID', $id)->delete();
            DB::table('product_star_lang')->where('PstarID', $id)->delete();
        }
        return redirect('/product/product_star');
    }

    public function product_application()
    {
        $application = App::make('App\ProductModel')->getProductApplication();

        return view('layout', ['main' => 'product_application', 'application' => $application]);
    }

    public function product_application_edit(Request $request, $id)
    {
        $query = App::make('App\ProductModel')->getProductApplicationByID($id);
        $lang = App::make('App\LangModel')->getLang();
        $post = $request->all();
        if ($post) {
//            if (Input::file('image')) {
//                $path = public_path() . '/site-images/product_application_product';
//                \File::makeDirectory($path, $mode = 0777, true, true);
//                $extension = Input::file('image')->getClientOriginalExtension();
//                $fileNmae = uniqid() . '.' . $extension;
//                $width = getimagesize(Input::file('image'))[0];
//                Input::file('image')->move($path, $fileNmae);
//                if ($width > 1600) {
//                    Image::make($path . '/' . $fileNmae)->resize(1600, null, function ($constraint) {
//                        $constraint->aspectRatio();
//                    })->save($path . '/' . $fileNmae);
//                }
//                $data['image'] = 'site-images/product_application_product/' . $fileNmae;
//                if ($query->image && file_exists($query->image)) {
//                    unlink($query->image);
//                }
//            }
            unset($post['_token']);
            $lang = $post['langs'];
            if ($lang) {
                foreach ($lang as $k => $lrow) {
                    DB::table('product_application_lang')->where('PalID', $lrow['PalID'])->update($lrow);
                }

            }
            return redirect('/product/product_application');
        }

        return view('layout', [
            'main' => 'product_application_edit',
            'query' => $query,
            'id' => $id,
            'lang' => $lang
        ]);

    }

    public function product_application_product(Request $request, $id)
    {
        $applicationProduct = App::make('App\ProductModel')->getProductApplicationProductByPaID($id);
        $count = App::make('App\ProductModel')->getApplicationProductCount($id);
        $post = $request->all();

        if ($post) {
            unset($post['_token']);
            foreach ($post['order'] as $k => $row) {
                DB::table('product_application_product')->where('PapID', $row)->update(['order' => $k+1]);
            }
            return redirect('/product/product_application_product/' . $id);
        }

        return view('layout', [
            'main' => 'product_application_product',
            'applicationProduct' => $applicationProduct,
            'id' => $id,
            'count' => $count
        ]);
    }

    public function product_application_product_add(Request $request, $id)
    {
        $count = App::make('App\ProductModel')->getApplicationProductCount($id);
        $order = App::make('App\ProductModel')->getProductApplicationOrder($id);
        if ($count >= 6) {
            return redirect('/product/product_application_product/' . $id);
        }

        $applicationProduct = App::make('App\ProductModel')->getProductApplicationProductByPaID($id);
        $lang = App::make('App\LangModel')->getLang();
        $post = $request->all();

        if ($post) {
            if (Input::file('image')) {
                $path = public_path() . '/site-images/product_application_product';
                \File::makeDirectory($path, $mode = 0777, true, true);
                $extension = Input::file('image')->getClientOriginalExtension();
                $fileNmae = uniqid() . '.' . $extension;
                $width = getimagesize(Input::file('image'))[0];
                Input::file('image')->move($path, $fileNmae);
                if ($width > 1600) {
                    Image::make($path . '/' . $fileNmae)->resize(1600, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path . '/' . $fileNmae);
                }
                $data['image'] = 'site-images/product_application_product/' . $fileNmae;
            }
            if (Input::file('image_thumb')) {
                $path = public_path() . '/site-images/product_application_product';
                \File::makeDirectory($path, $mode = 0777, true, true);
                $extension = Input::file('image_thumb')->getClientOriginalExtension();
                $fileNmae = uniqid() . '.' . $extension;
                $width = getimagesize(Input::file('image_thumb'))[0];
                Input::file('image_thumb')->move($path, $fileNmae);
                if ($width > 320) {
                    Image::make($path . '/' . $fileNmae)->resize(320, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path . '/' . $fileNmae);
                }
                $data['image_thumb'] = 'site-images/product_application_product/' . $fileNmae;
            }
            unset($post['_token']);
            $lang = $post['langs'];
            $data['paID'] = $id;
            $data['order'] = $order + 1;
            $getid = DB::table('product_application_product')->insertGetId($data);
            if ($lang) {
                foreach ($lang as $k => $lrow) {
                    $lang[$k]['papID'] = $getid;
                }
                DB::table('product_application_product_lang')->insert($lang);
            }
            return redirect('/product/product_application_product/' . $id);
        }

        return view('layout', [
            'main' => 'product_application_product_add',
            'applicationProduct' => $applicationProduct,
            'id' => $id,
            'lang' => $lang
        ]);
    }

    public function product_application_product_edit(Request $request, $id, $previd)
    {
        $query = App::make('App\ProductModel')->getProductApplicationProductByPapID($id);
        $lang = App::make('App\LangModel')->getLang();
        $post = $request->all();

        if ($post) {
            if (Input::file('image')) {
                $path = public_path() . '/site-images/product_application_product';
                \File::makeDirectory($path, $mode = 0777, true, true);
                $extension = Input::file('image')->getClientOriginalExtension();
                $fileNmae = uniqid() . '.' . $extension;
                $width = getimagesize(Input::file('image'))[0];
                Input::file('image')->move($path, $fileNmae);
                if ($width > 1600) {
                    Image::make($path . '/' . $fileNmae)->resize(1600, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path . '/' . $fileNmae);
                }
                $data['image'] = 'site-images/product_application_product/' . $fileNmae;
                if ($query->image && file_exists($query->image)) {
                    unlink($query->image);
                }
            }
            if (Input::file('image_thumb')) {
                $path = public_path() . '/site-images/product_application_product';
                \File::makeDirectory($path, $mode = 0777, true, true);
                $extension = Input::file('image_thumb')->getClientOriginalExtension();
                $fileNmae = uniqid() . '.' . $extension;
                $width = getimagesize(Input::file('image_thumb'))[0];
                Input::file('image_thumb')->move($path, $fileNmae);
                if ($width > 320) {
                    Image::make($path . '/' . $fileNmae)->resize(320, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path . '/' . $fileNmae);
                }
                $data['image_thumb'] = 'site-images/product_application_product/' . $fileNmae;
                if ($query->image_thumb && file_exists($query->image_thumb)) {
                    unlink($query->image_thumb);
                }
            }
            if(isset($data)){
                DB::table('product_application_product')
                    ->where('PapID', $id)
                    ->update($data);
            }
            unset($post['_token']);
            $lang = $post['langs'];
            if ($lang) {
                foreach ($lang as $k => $lrow) {
                    DB::table('product_application_product_lang')->where('PaplID', $lrow['PaplID'])->update($lrow);
                }

            }
            return redirect('/product/product_application_product/' . $previd);
        }


        return view('layout', [
            'main' => 'product_application_product_edit',
            'query' => $query,
            'id' => $id,
            'previd' => $previd,
            'lang' => $lang
        ]);

    }

    public function product_application_product_delete($id, $previd)
    {
        $query = App::make('App\ProductModel')->getProductApplicationProductByPapID($id);
        if ($query) {
            if ($query->image && file_exists($query->image)) {
                unlink($query->image);
            }
            if ($query->image_thumb && file_exists($query->image_thumb)) {
                unlink($query->image_thumb);
            }
            DB::table('product_application_product')->where('PapID', $id)->delete();
            DB::table('product_application_product_lang')->where('PapID', $id)->delete();
        }
        return redirect('/product/product_application_product/' . $previd);
    }


    public function product_seo(Request $request)
    {
        $lang = App::make('App\LangModel')->getLang();
        $seo = App::make('App\SeoModel')->getSeo('product');
        $post = $request->all();
        if ($post) {
            unset($post['_token']);
            $seo_lang = $post['langs'];
            if ($seo_lang) {
                foreach ($seo_lang as $k => $lrow) {
                    DB::table('seo_lang')->where('SeolangID', $lrow['SeolangID'])->update($lrow);
                }
            }
            return redirect('/product/product_seo');
        }
        return view('layout', ['main' => 'product_seo', 'lang' => $lang, 'seo' => $seo]);
    }


    public function product_star_seo(Request $request)
    {
        $lang = App::make('App\LangModel')->getLang();
        $seo = App::make('App\SeoModel')->getSeo('product_star');
        $post = $request->all();
        if ($post) {
            unset($post['_token']);
            $seo_lang = $post['langs'];
            if ($seo_lang) {
                foreach ($seo_lang as $k => $lrow) {
                    DB::table('seo_lang')->where('SeolangID', $lrow['SeolangID'])->update($lrow);
                }
            }
            return redirect('/product/product_star_seo');
        }
        return view('layout', ['main' => 'product_star_seo', 'lang' => $lang, 'seo' => $seo]);
    }

    public function product_application_seo(Request $request)
    {
        $lang = App::make('App\LangModel')->getLang();
        $seo = App::make('App\SeoModel')->getSeo('product_application');
        $post = $request->all();
        if ($post) {
            unset($post['_token']);
            $seo_lang = $post['langs'];
            if ($seo_lang) {
                foreach ($seo_lang as $k => $lrow) {
                    DB::table('seo_lang')->where('SeolangID', $lrow['SeolangID'])->update($lrow);
                }
            }
            return redirect('/product/product_application_seo');
        }
        return view('layout', ['main' => 'product_application_seo', 'lang' => $lang, 'seo' => $seo]);
    }

    public function delete_product_category_PDF($id)
    {

        $query = App::make('App\ProductModel')->getProductCategoryByPcID($id);
        if ($query) {
            if ($query->file && file_exists($query->file)) {
                unlink($query->file);
            }
            DB::table('product_category')->where('PcID', $id)->update(['file' => '', 'file_name' => '']);
        }
        return redirect('/product/product_category_edit/' . $id);
    }

    public function delete_product_sub_category_PDF($id, $previd)
    {
        $query = App::make('App\ProductModel')->getProductSubCategorybyPscID($id);
        if ($query) {
            if ($query->file && file_exists($query->file)) {
                unlink($query->file);
            }
            DB::table('product_sub_category')->where('PscID', $id)->update(['file' => '', 'file_name' => '']);
        }
        return redirect('/product/product_sub_category_edit/' . $id . '/' . $previd);
    }

}
