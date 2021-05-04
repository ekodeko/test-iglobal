<?php

namespace App\Http\Controllers;

use App\Helpers\MyHelper;
use App\MarketingKit;
use App\MarketingKitItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MarketingKitController extends Controller
{
    public function index()
    {
        return view('content.utility.marketing_kit_list', [
            'title' => 'Reseller Marketing Kit',
            'marketing_kits'    => MarketingKit::all()
        ]);
    }
    public function create()
    {
        return view('content.marketing_kit.create', ['title'    => 'Tambah Reseller Marketing Kit']);
    }
    public function store(Request $request)
    {
        $picname = 'undraw_images.svg';
        $path = 'images';
        $validator = Validator::make($request->all(), [
            'title'  => 'required|unique:marketing_kits,title'
        ], [
            'title.required' => 'Judul Marketing Kit Wajib diisi',
            'title.unique' => 'Judul Marketing Kit telah terdaftar'
        ]);
        if ($validator->fails()) {
            MyHelper::setMessage('Oooppsss', 'error', $validator->errors()->first());
            return back();
        }
        if ($request->hasFile('image')) {
            $validator =  Validator::make($request->all(), [
                'image' => 'required|image|mimes:jpeg,png,jpg|max:512',
            ]);
            if ($validator->fails()) {
                MyHelper::setMessage('Oooppsss', 'error', 'Terjadi kesalahan saat mengunggah gambar!');
                return back();
            }
            $image = $request->file('image');
            $img_ext = $image->getClientOriginalExtension();
            $img_name = sha1(time()) . '.' . $img_ext;
            $picname = $img_name;
            // simpen file--------------
            Storage::putFileAs($path, $request->file('image'), $picname);
            // insert thumbnail
            // bikin thumbnail
            // $image_thumbnail_path = public_path('images/thumb/' . $picname);
            // dd($image_thumbnail_path);
            MyHelper::createThumbnail(public_path($path), $picname, 150, 150);
        }
        // insert---------------------
        MarketingKit::create([
            'title'      => $request->title,
            'thumbnail' => $picname,
            'is_many_file'  => $request->is_many_file
        ]);
        MyHelper::setMessage('Berhasil', 'success', 'Marketing Kit baru berhasil di tambahkan');
        return back();
    }
    public function foto_produk()
    {
        return view('content.marketing_kit.foto_produk_list', [
            'title' => 'Foto Produk'
        ]);
    }
    public function download_foto_produk()
    {
        $pathToFile = storage_path('app\public\images\reseller\1e37548b9283cae12e2940ef308f303a2189ca4c.jpg');
        return response()->download($pathToFile);
    }
    public function video_produk()
    {
        return view('content.marketing_kit.video_produk_list', [
            'title' => 'Video Produk'
        ]);
    }
    public function download_video_produk()
    {
        $pathToFile = storage_path('app\public\images\reseller\1e37548b9283cae12e2940ef308f303a2189ca4c.jpg');
        return response()->download($pathToFile);
    }
    public function foto_endorse()
    {
        return view('content.marketing_kit.foto_endorse_list', [
            'title' => 'Foto Endorse Artis'
        ]);
    }
    public function download_foto_endorse()
    {
        $pathToFile = storage_path('app\public\images\reseller\1e37548b9283cae12e2940ef308f303a2189ca4c.jpg');
        return response()->download($pathToFile);
    }
    public function video_endorse()
    {
        return view('content.marketing_kit.foto_endorse_list', [
            'title' => 'Video Endorse Artis'
        ]);
    }
    public function download_video_endorse()
    {
        $pathToFile = storage_path('app\public\images\reseller\1e37548b9283cae12e2940ef308f303a2189ca4c.jpg');
        return response()->download($pathToFile);
    }
    public function booklet()
    {
        return view('content.marketing_kit.booklet_list', [
            'title' => 'Booklet'
        ]);
    }
    public function download_booklet()
    {
        $pathToFile = storage_path('app\public\images\reseller\1e37548b9283cae12e2940ef308f303a2189ca4c.jpg');
        return response()->download($pathToFile);
    }
    public function template_pesan_wa()
    {
        return view('content.marketing_kit.template_wa_list', [
            'title' => 'Template pesan Whatsapp'
        ]);
    }
    public function download_template_pesan_wa()
    {
        $pathToFile = storage_path('app\public\images\reseller\1e37548b9283cae12e2940ef308f303a2189ca4c.jpg');
        return response()->download($pathToFile);
    }
    public function items($id)
    {

        $marketing_kit = MarketingKit::with('items')->where('id', '=', $id)->first();
        return view('content.marketing_kit.items', ['title' => 'Daftar ' . $marketing_kit->title, 'marketing_kit' => $marketing_kit]);
    }
}
