<?php

namespace App\Http\Controllers;

use App\Category;
use App\Course;
use App\Helpers\MyHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('content.course.list', ['title' => 'Kategori Pelatihan', 'categories'  => $categories]);
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
        $validator = Validator::make($request->all(), [
            'title'  => 'required|unique:courses,title',
            'link_embed'    => 'required'
        ], [
            'title.required' => 'Judul pelatihan Wajib diisi',
            'title.unique' => 'Judul pelatihan telah terdaftar',
            'link_embed.required'   => 'Embed Youtube wajib diisi'
        ]);
        if ($validator->fails()) {
            MyHelper::setMessage('Oooppsss', 'error', $validator->errors()->first());
            return back();
        }
        Course::create([
            'category_id'               => $request->category_id,
            'title'                     => $request->title,
            'level_requirement'         => $request->level_requirement,
            'link_embed'                => $request->link_embed
        ]);
        MyHelper::setMessage('Berhasil', 'success', 'Pelatihan baru berhasil di tambahkan');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $courses = Course::where('category_id', $id)->get();
        return view('content.course.course_list', ['title' => 'Daftar Pelatihan', 'courses'  => $courses]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('content.course.edit', ['title' => 'Ubah Detail Pelatihan', 'course'  => Course::findOrFail($id)]);
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
        $validator = Validator::make($request->all(), [
            'title'  => 'required|unique:courses,title',
            'link_embed'    => 'required'
        ], [
            'title.required' => 'Judul pelatihan Wajib diisi',
            'title.unique' => 'Judul pelatihan telah terdaftar',
            'link_embed.required'   => 'Embed Youtube wajib diisi'
        ]);
        if ($validator->fails()) {
            MyHelper::setMessage('Oooppsss', 'error', $validator->errors()->first());
            return back();
        }
        Course::where('id', $id)->update([
            'title'         => $request->title,
            'level_requirement'         => $request->level_requirement,
            'link_embed'    => $request->link_embed
        ]);
        MyHelper::setMessage('Berhasil', 'success', 'Pelatihan berhasil diubah');
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
        Course::where('id', $id)->delete();
        MyHelper::setMessage('Berhasil', 'success', 'Data berhasil di hapus');
        return back();
    }
    public function watch($id)
    {
        $course = Course::findOrFail($id);
        return view('content.course.watch', ['title' => $course->title, 'course'  => $course]);
    }
}
