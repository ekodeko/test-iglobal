<?php

namespace App\Http\Controllers;

use App\Category;
use App\Helpers\MyHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('content.category.list', ['title' => 'Category', 'categories'  => Category::with('courses')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $picname = 'undraw_images.png';
        $path = 'images';
        $validator = Validator::make($request->all(), [
            'name'  => 'required|unique:categories,name'
        ], [
            'name.required' => 'Nama Kategori Wajib diisi',
            'name.unique' => 'Nama Kategori telah terdaftar'
        ]);
        if ($validator->fails()) {
            MyHelper::setMessage('Oooppsss', 'error', $validator->errors()->first());
            return back();
        }
        if ($request->hasFile('thumbnail')) {
            $validator =  Validator::make($request->all(), [
                'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:512',
            ]);
            if ($validator->fails()) {
                MyHelper::setMessage('Oooppsss', 'error', 'Terjadi kesalahan saat mengunggah gambar!');
                return back();
            }
            $image = $request->file('thumbnail');
            $img_ext = $image->getClientOriginalExtension();
            // $img_name = sha1(crypt('reseller-image' . date('sisisi'), '')) . '.' . $img_ext;
            $img_name = sha1(time()) . '.' . $img_ext;
            Storage::putFileAs($path, $request->file('thumbnail'), $img_name);
            $picname = $img_name;
        }
        Category::create([
            'name'      => $request->name,
            'thumbnail' => $picname
        ]);
        MyHelper::setMessage('Berhasil', 'success', 'Kategori baru berhasil di tambahkan');
        return redirect('category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('content.category.show', ['title' => $category->name, 'category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $picname = $request->thumbnail_old;
        $path = 'images';
        $validator = Validator::make($request->all(), [
            'name'  => 'required'
        ], [
            'name.required' => 'Nama Kategori Wajib diisi',
            // 'name.unique' => 'Nama Kategori telah terdaftar'
        ]);
        if ($validator->fails()) {
            MyHelper::setMessage('Oooppsss', 'error', $validator->errors()->first());
            return back();
        }
        if ($request->hasFile('thumbnail')) {
            $validator =  Validator::make($request->all(), [
                'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:512',
            ]);
            if ($validator->fails()) {
                MyHelper::setMessage('Oooppsss', 'error', 'Terjadi kesalahan saat mengunggah gambar!');
                return back();
            }
            $image = $request->file('thumbnail');
            $img_ext = $image->getClientOriginalExtension();
            $img_name = sha1(time()) . '.' . $img_ext;
            Storage::putFileAs($path, $request->file('thumbnail'), $img_name);
            $picname = $img_name;
        }
        Category::where('id', $id)->update([
            'name'      => $request->name,
            'thumbnail' => $picname
        ]);
        MyHelper::setMessage('Berhasil', 'success', 'Kategori baru berhasil di tambahkan');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::where('id', $id)->delete();
        MyHelper::setMessage('Berhasil', 'success', 'Data berhasil di hapus');
        return back();
    }
}
