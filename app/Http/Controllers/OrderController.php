<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show_form_add_order()
    {
        return view('content.order.add', [
            'title' => 'Create New Order'
        ]);
    }

    public function receipt_list()
    {
        return view('content.order.receipt_list', [
            'title' => 'Daftar Resi'
        ]);
    }
}
