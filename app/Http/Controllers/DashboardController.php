<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        // reseller leaderboard
        $users_top = DB::table('users')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->select('users.id', 'users.name', DB::raw('SUM(orders.gross_revenue) as total_pembelian'))
            ->where('orders.status', 'completed')
            ->groupBy('id', 'name')
            ->orderBy('total_pembelian', 'desc')
            ->limit(5)
            ->get();
        // pie chart reseller location
        $reseller_location  = DB::table('users')->select('city', DB::raw('COUNT(*) as jumlah_reseller'))->where('city', '!=', '')->groupBy('city')->orderBy('jumlah_reseller', 'desc')->get();
        $clean_reseller_location = [];
        foreach ($reseller_location as $key => $value) {
            $push = true;
            $reseller = (object)[
                'city'  => $this->cleaningCityName(strtoupper($value->city)),
                'jumlah_reseller'  => $value->jumlah_reseller
            ];
            foreach ($clean_reseller_location as $k => $v) {
                if ($v->city == $this->cleaningCityName(strtoupper($value->city))) {
                    $clean_reseller_location[$k]->jumlah_reseller +=  $value->jumlah_reseller;
                    $push = false;
                }
            }
            if ($push) {
                array_push($clean_reseller_location, $reseller);
            }
        }
        $reseller_location_data = [];
        foreach ($clean_reseller_location as $key => $value) {
            if ($key > 9) {
                break;
            }
            $reseller_location_data['label'][]    = $value->city;
            $reseller_location_data['data'][]    = $value->jumlah_reseller;
        }
        // pie chart lokasi penjualan terbanyak
        $highest_sell    = DB::table('users')->join('orders', 'users.id', '=', 'orders.user_id')->select('city', DB::raw('SUM(gross_revenue) as total_penjualan'))->where('status', 'completed')->groupBy('city')->orderBy('total_penjualan', 'desc')->get();
        $highest_sell_clean = [];
        foreach ($highest_sell as $key => $value) {
            $push = true;
            $highest_sell = (object)[
                'city'  => $this->cleaningCityName(strtoupper($value->city)),
                'total_penjualan'  => $value->total_penjualan
            ];
            foreach ($highest_sell_clean as $k => $v) {
                if ($v->city == $this->cleaningCityName(strtoupper($value->city))) {
                    $highest_sell_clean[$k]->total_penjualan +=  $value->total_penjualan;
                    $push = false;
                }
            }
            if ($push) {
                array_push($highest_sell_clean, $highest_sell);
            }
        }
        $highest_sell_data = [];
        foreach ($highest_sell_clean as $key => $value) {
            if ($key > 9) {
                break;
            }
            $highest_sell_data['label'][]    = $value->city;
            $highest_sell_data['data'][]    = $value->total_penjualan;
        }

        // user data 
        $user  = User::with(['orders'   => function ($query) {
            $query->where('user_id', '=', Auth::user()->id);
            $query->where('status', '=', 'completed');
        }, 'sales' => function ($query) {
            $month_before   = date('m', strtotime('-1 months'));
            $month_current  = date('m');
            $query->sum('quantity');
            $query->whereRaw("Month(created_at) BETWEEN $month_before AND $month_current");
            $query->where('user_id', '=', Auth::user()->id);
        }])->where('id', '=', Auth::user()->id)->first();
        // user monthly
        $user_monthly  = User::with(['orders'   => function ($query) {
            $query->where('user_id', '=', Auth::user()->id);
            $query->where('status', '=', 'completed');
            $query->whereMonth('created_at', date('m'));
        }, 'sales' => function ($query) {
            $month_current  = date('m');
            $query->sum('quantity');
            $query->whereMonth('created_at', $month_current);
            $query->where('user_id', '=', Auth::user()->id);
        }])->where('id', '=', Auth::user()->id)->first();
        // user yearly
        $user_yearly  = User::with(['orders'   => function ($query) {
            $query->where('user_id', '=', Auth::user()->id);
            $query->where('status', '=', 'completed');
            $query->whereYear('created_at', date('Y'));
        }, 'sales' => function ($query) {
            $year_current  = date('Y');
            $query->sum('quantity');
            $query->whereYear('created_at', $year_current);
            $query->where('user_id', '=', Auth::user()->id);
        }])->where('id', '=', Auth::user()->id)->first();
        // user data
        $user_data  = User::with(['orders'   => function ($query) {
            $query->where('user_id', '=', Auth::user()->id);
            $query->where('status', '=', 'completed');
        }, 'sales' => function ($query) {
            $query->sum('quantity');
            $query->where('user_id', '=', Auth::user()->id);
        }])->where('id', '=', Auth::user()->id)->first();
        // $arr_eliminate_periode = ['0102', '0304', '0506', '0708', '0910', '1112'];
        return view('content.dashboard', [
            'users_top'                 => $users_top,
            'reseller_location_data'    => json_encode($reseller_location_data),
            'highest_sell_data'         => json_encode($highest_sell_data),
            'user'                      => $user,
            'user_data'                 => $user_data,
            'user_monthly'              => $user_monthly,
            'user_yearly'               => $user_yearly,
            'product'                   => new Product
        ]);
    }
    private function cleaningCityName($string)
    {

        $in = array('#\bKAB. \b#', '#\bKOTA \b#');
        $out = array('');
        $string = preg_replace($in, $out, $string);
        return $string;
    }
}
