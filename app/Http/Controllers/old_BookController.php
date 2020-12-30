<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Dokter;
use App\Book;

class BookController extends Controller
{
    //
    public function index()
    {
        # code...
        $list_dokter = Dokter::all();
        return view('content.book', [
            'list_dokter'   => $list_dokter
        ]);
    }
    public function create_booking(Request $request)
    {
        $request->validate([
            'nama'      => 'required',
            'telepon'   => 'max:13',
            'tgl_lahir'   => 'required',
            'tgl'   => 'required',
            'jam'   => 'required',
        ], [
            'nama.required'   => 'Nama pasien wajib di isi',
            'tgl_lahir.required'   => 'Tanggal Lahir wajib di isi',
            'tgl.required'   => 'Tanggal Kunjungan wajib dipilih',
            'jam.required'   => 'Jam Kunjungan Wajib di pilih',
            'telepon.max'   => 'No. telepon max 13 karakter',
        ]);
        $booking_exists = Book::where('id_dokter', $request->dokter)
            ->where('tanggal_kunjungan', $request->tgl)
            ->where('jam_kunjungan', $request->jam)
            ->first();
        if ($booking_exists) {
            return redirect('/')->with('message', 'Dokter sudah memiliki jadwal praktek pada jam tersebut');
        }
        Book::create([
            'nama_pasien'   => $request->nama,
            'telepon'   => $request->telepon,
            'tanggal_lahir'   => $request->tgl_lahir,
            'id_dokter'   => $request->dokter,
            'tanggal_kunjungan'   => $request->tgl,
            'jam_kunjungan'   => $request->jam,
            'pesan'   => $request->pesan,
        ]);
        return redirect('/')->with('sukses', 'Jadwal Kunjungan Dokter berhasil di booking');
    }
    public function booking_list()
    {
        // $list_booking = DB::table('ts_booking')
        //     ->join('ms_dokter', 'ts_booking.id_dokter', '=', 'ms_dokter.id')
        //     ->select('ts_booking.*', 'ms_dokter.nama_dokter')
        //     ->get();

        $list_booking = Book::all();

        // dd($list_booking);
        return view('content.book_list', [
            'list_booking'   => $list_booking
        ]);
    }
}
