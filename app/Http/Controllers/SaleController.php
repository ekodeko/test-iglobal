<?php

namespace App\Http\Controllers;

use App\Helpers\MyHelper;
use App\Product;
use App\Sale;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SaleController extends Controller
{
    public function index()
    {
        # code...
    }

    public function show_form_input_sale()
    {
        return view('content.sale.input_sale', [
            'title' => 'Input Penjualan'
        ]);
    }

    public function store_input_sale(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'quantity'  => 'required|numeric'
        ], [
            'required'  => 'Jumlah barang harus diisi!',
            'numeric'  => 'Jumlah barang berupa angka!',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        // getting user data
        $user_data  = User::with(['orders'   => function ($query) {
            $month_before   = date('m', strtotime('-1 months'));
            $month_current  = date('m');
            // $query->whereRaw("Month(created_at) BETWEEN $month_before AND $month_current");
            $query->where('user_id', '=', Auth::user()->id);
            $query->where('status', '=', 'completed');
        }, 'sales'   => function ($query) {
            $month_before   = date('m', strtotime('-1 months'));
            $month_current  = date('m');
            $query->whereRaw("Month(created_at) BETWEEN $month_before AND $month_current");
            $query->where('user_id', '=', Auth::user()->id);
        }])->where('id', '=', Auth::user()->id)->first();

        $user = new User();
        $product = new Product();
        // $stok = $user_data->orders->sum('quantity') * $product->product_per_box;
        $stok = ($user_data->orders->sum('quantity') * $product->product_per_box) - $user_data->sales->sum('quantity');
        $level = Auth::user()->level;

        if ($request->quantity > $stok) {
            MyHelper::setMessage('Gagal!', 'error', 'Jumlah yang kamu input melebihi stok kamu');
            return back();
        } else if ($request->quantity == 0) {
            MyHelper::setMessage('Gagal!', 'error', 'Jumlah barang tidak boleh 0');
            return back();
        }

        $sale   = new Sale;
        $sale->quantity = $request->quantity;
        $sale->save();
        $sale->users()->attach(Auth::user()->id);

        if ($stok >= $user->gold && $stok < $user->platinum) {
            $level = 1;
        } else if ($stok >= $user->platinum && $stok < $user->diamond) {
            $level = 2;
        } elseif ($stok >= $user->diamond) {
            $level = 3;
        } else {
            $level = $level;
        }

        if (Auth::user()->level != $level) {
            MyHelper::setMessage('Yeayyyyyyy!!!', 'success', 'Selamat kamu berhasil naik ke level ' . $level . ' Kelas yang terkunci sudah dapat kamu tonton beserta benefit menarik lain, terus tingkatkan penjualan kamu untuk terus naik level');
        }
        MyHelper::setMessage('Berhasil!', 'success', 'Penjualan berhasil di input');
        return back();
    }

    public function show_form_set_sell_price()
    {
        return view('content.sale.set_sell_price', [
            'title' => 'Atur Harga Jual',
            'sell_price'    => User::find(Auth::user()->id)->sell_price
        ]);
    }
    public function update_set_sell_price(Request $request)
    {
        $product = new Product;
        $validator = Validator::make($request->all(), [
            'sell_price'  => 'required|numeric|min:6250'
        ], [
            'required'  => 'Harga Jual harus diisi!',
            'numeric'  => 'Harga Jual harus berupa angka!',
            'min'  => 'Harga Jual tidak boleh dibawah ' . $product->product_het,
        ]);
        if ($validator->fails()) {
            return redirect('sale/set_sell_price')
                ->withErrors($validator)
                ->withInput();
        }
        $user   = User::find($request->user_id);
        $user->sell_price = $request->sell_price;
        $user->save();
        MyHelper::setMessage('Berhasil', 'success', 'Harga Jual berhasil di perbarui');
        return back();
    }
}
