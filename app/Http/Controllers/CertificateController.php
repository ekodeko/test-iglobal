<?php

namespace App\Http\Controllers;

use App\Certificate;
use Illuminate\Http\Request;
use App\Dokter;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_certificate = Certificate::all();
        return view('content.certificate.index', ['list_certificate'  => $list_certificate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('content.certificate.create');
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
            'certificate_number'   => 'required|max:100|unique.ms_certificate'
        ], $this->messages());
        Dokter::create($request->all());

        return redirect('/certificate')->with('status', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $certificate = Certificate::findOrFail($id);
        return view('content.certificate.edit', compact('certificate'));
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
            'certificate_number'   => 'required|max:100|unique.ms_certificate'
        ], $this->messages());
        Dokter::where('id', $id)
            ->update([
                'certificate_number'   => $request->certificate_number
            ]);
        return redirect('/certificate')->with('status', 'Data berhasil diubah!');
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
        return redirect('/certificate')->with('status', 'Data berhasil dihapus!');
    }
    private function messages()
    {
        return [
            'certificate_number.required'  => 'Nomer Sertifikat Wajib di isi!',
            'certificate_number.max'  => 'Nomer Sertifikat terlalu panjang!',
            'certificate_number.unique'  => 'Nomer Sertifikat telah terdaftar!',
        ];
    }
}
