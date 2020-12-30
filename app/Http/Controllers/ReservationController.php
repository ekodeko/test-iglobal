<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\DokterPasien;
use App\Dokter;

class ReservationController extends Controller
{
    //
    public function index()
    {
        $list_reservation = DokterPasien::all();
        // dd($list_reservation);
        return view('content.reservation.list', [
            'list_reservation'   => $list_reservation
        ]);
    }
    public function ajax_index(Request $request)
    {
        if ($request->ajax()) {
            $list_reservation = DokterPasien::with('dokter', 'user')->select('ts_dokter_pasien.*');

            $date_visit = (!empty($_GET["date_visit"])) ? ($_GET["date_visit"]) : ('');
            $time_visit = (!empty($_GET["time_visit"])) ? ($_GET["time_visit"]) : ('');

            if ($date_visit) {
                # code...
                $date_visit = date('Y-m-d', strtotime($date_visit));
                $list_reservation = DokterPasien::with('dokter', 'user')->select('ts_dokter_pasien.*')->where('tanggal_kunjungan', $date_visit);
            } else if ($date_visit && $time_visit) {
                # code...
                $date_visit = date('Y-m-d', strtotime($date_visit));
                $time_visit = date('H:i', strtotime($time_visit));
                $list_reservation = DokterPasien::with('dokter', 'user')->select('ts_dokter_pasien.*')->where('tanggal_kunjungan', $date_visit)->where('jam_kunjungan', $time_visit);
            }

            return DataTables::of($list_reservation)
                ->addColumn('dokter', function (DokterPasien $dokterPasien) {
                    return $dokterPasien->dokter ? $dokterPasien->dokter->nama_dokter : '';
                })
                ->addColumn('user', function (DokterPasien $dokterPasien) {
                    return $dokterPasien->user ? $dokterPasien->user->name : '';
                })
                ->addColumn('action', function ($list_reservation) {
                    return ' <a href="dokter/' . $list_reservation->id . '" class="btn btn-success btn-sm">Lihat</a> <a href="dokter/' . $list_reservation->id . '/edit" class="btn btn-info btn-sm">Edit</a> <a href="dokter/delete_dokter/' . $list_reservation->id . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Data akan di hapus, Lanjutkan?\')">Hapus</a>';
                })->make(true);
        }
        return view('content.reservation.ajax_list');
    }
    public function create_reservation()
    {
        # code...
        $list_dokter = Dokter::all();
        return view('content.reservation.create_reservation', [
            'list_dokter'   => $list_dokter
        ]);
    }
    public function store_reservation(Request $request)
    {
        $request->validate([
            'tgl'   => 'required',
            'jam'   => 'required',
        ], [
            'tgl.required'   => 'Tanggal Kunjungan wajib dipilih',
            'jam.required'   => 'Jam Kunjungan Wajib di pilih',
        ]);
        $reservation_exists = DokterPasien::where('dokter_id', $request->dokter)
            ->where('tanggal_kunjungan', $request->tgl)
            ->where('jam_kunjungan', $request->jam)
            ->first();
        if ($reservation_exists) {
            return back()->with('message', 'Dokter sudah memiliki jadwal praktek pada jam tersebut');
        }
        DokterPasien::create([
            'dokter_id'     => $request->dokter,
            'user_id'       => Auth::id(),
            'tanggal_kunjungan'   => $request->tgl,
            'jam_kunjungan'   => $request->jam,
            'pesan'   => $request->pesan,
        ]);
        return redirect('/reservation')->with('sukses', 'Jadwal Kunjungan Dokter berhasil di buat');
    }
}
