<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dokter;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
// use Datatables;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //     $listDokter = Dokter::all();
        //     return view('content.dokter.index', ['list_dokter'  => $listDokter]);
        if ($request->ajax()) {
            # code...
            $dokter = Dokter::with('certificate')->select('ms_dokter.*');
            return DataTables::of($dokter)
                ->addColumn('certificate', function (Dokter $dokter) {
                    return $dokter->certificate ? $dokter->certificate->certificate_number : '';
                })
                ->addColumn('action', function ($dokter) {
                    return (Auth::user()->role_id == 1) ? '<a href="dokter/' . $dokter->id . '" class="btn btn-success btn-sm">Lihat</a>' : '<a href="dokter/' . $dokter->id . '" class="btn btn-success btn-sm">Lihat</a> <a href="dokter/' . $dokter->id . '/edit" class="btn btn-info btn-sm">Edit</a> <a href="dokter/delete_dokter/' . $dokter->id . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Data akan di hapus, Lanjutkan?\')">Hapus</a>';
                })->make(true);
            // return DataTables::of($dokter)->make(true);
        }
        return view('content.dokter.ajax_index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('content.dokter.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_dokter'   => 'required|max:128'
        ], $this->messages());
        Dokter::create($request->all());

        return redirect('/dokter')->with('status', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dokter = Dokter::findOrFail($id);
        return view('content.dokter.detail', compact('dokter'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dokter = Dokter::findOrFail($id);
        return view('content.dokter.edit', compact('dokter'));
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
        $request->validate([
            'nama_dokter'   => 'required|max:128'
        ], $this->messages());
        Dokter::where('id', $id)
            ->update([
                'nama_dokter'   => $request->nama_dokter,
                'telp'   => $request->telp,
            ]);
        return redirect('/dokter')->with('status', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Dokter::destroy($id);
        return redirect('/dokter')->with('status', 'Data berhasil dihapus!');
    }

    public function ajaxIndex()
    {
        # code...
        return view('content.dokter.ajax_index');
    }
    public function getData(Request $request)
    {
        # code...
        if ($request->ajax()) {
            # code...
            $dokter = Dokter::with('certificate')->select('ms_dokter.*');

            $showBtn    = '<a href="' . $dokter->id . '" class="btn btn-success btn-sm">Lihat</a>';
            if (Auth::user()->role_id == 2) {
                $editBtn    = '<a href="' . $dokter->id . '/edit" class="btn btn-info btn-sm">Edit</a>';
                $deleteBtn  = '<a href="delete_dokter/' . $dokter->id . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Data akan di hapus, Lanjutkan?\')">Hapus</a>';
            }
            return DataTables::of($dokter)
                ->addColumn('certificate', function (Dokter $dokter) {
                    return $dokter->certificate ? $dokter->certificate->certificate_number : '';
                })
                ->addColumn('action', function ($dokter) {
                    return $showBtn;
                })->make(true);
            // return DataTables::of($dokter)->make(true);
        }
        return view('content.dokter.ajax_index');
    }

    private function messages()
    {
        return [
            'nama_dokter.required'  => 'Nama Dokter Wajib di isi!',
            'nama_dokter.max'  => 'Nama Dokter terlalu panjang!',
        ];
    }
}
