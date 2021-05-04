<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResellerMarketingKit extends Controller
{
    public function index()
    {
        return view('content.utility.marketing_kit_list', [
            'title' => 'Reseller Marketing Kit'
        ]);
    }
    public function create()
    {
        return view('content.marketing_kit.create', ['title'    => 'Tambah Reseller Marketing Kit']);
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
}
