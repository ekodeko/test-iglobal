<?php

namespace App\Http\Controllers;

use App\Customer;
use App\User;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Helpers\MyHelper;
use App\Order;
use App\Product;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('content.dashboard', ['title'   => 'Dashboard']);
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function profile()
    {
        $product    = new Product();

        $user  = User::with(['orders'   => function ($query) {
            $query->where('user_id', '=', Auth::user()->id);
            $query->where('status', '=', 'completed');
        }, 'sales' => function ($query) {
            $query->sum('quantity');
            $query->where('user_id', '=', Auth::user()->id);
        }])->where('id', '=', Auth::user()->id)->first();
        return view('content.user.profile', [
            'title' => 'Profile Reseller',
            'user'  => $user,
            'product_per_box'   => $product->product_per_box,
            'product_het'   => $product->product_het
        ]);
    }

    public function change_picture(Request $request)
    {
        $picname = 'default.png';
        // IMAGE VALIDATION //
        $path = 'images/reseller';
        if ($request->hasFile('profile_picture')) {
            $validator =  Validator::make($request->all(), [
                'profile_picture' => 'required|image|mimes:jpeg,png,jpg|max:512',
            ]);
            if ($validator->fails()) {
                MyHelper::setMessage('Oooppsss', 'error', 'Terjadi kesalahan saat mengunggah gambar!');
                return back();
            }
            $image = $request->file('profile_picture');
            $img_ext = $image->getClientOriginalExtension();
            // $img_name = sha1(crypt('reseller-image' . date('sisisi'), '')) . '.' . $img_ext;
            $img_name = sha1(time()) . '.' . $img_ext;
            // Image::make($image->getRealPath())->save($path . $img_name);
            Storage::putFileAs($path, $request->file('profile_picture'), $img_name);
            $picname = $img_name;
            // dd($picname);
            User::where('id', Auth::user()->id)->update(['profile_picture' => $picname]);
            MyHelper::setMessage('Berhasil!', 'success', 'Foto profil berhasil diperbarui');
            return back();
        }
    }
    public function reseller_list()
    {
        $user = User::where('role', 'user')->get();
        return view('content.user.reseller_list', [
            'title'     => 'Data reseller',
            'resellers' => $user
        ]);
    }
    public function show_form_change_password()
    {
        return view('content.user.change_password', [
            'title' => 'Ganti Password'
        ]);
    }
    public function change_password(Request $request)
    {
        $validation = $request->validate([
            'old_password'  => 'required',
            'password'  => 'required|min:3|confirmed',
            'password_confirmation'  => 'required',
        ]);
        if (!password_verify($request->old_password, Auth::user()->password)) {
            MyHelper::setMessage('Gagal!!!', 'error', 'Password lama yang anda masukan salah!');
            return back();
        }
        User::where('id', Auth::user()->id)
            ->update(['password'    => password_hash($request->password, PASSWORD_DEFAULT)]);
        MyHelper::setMessage('Berhasil!!!', 'success', 'Password anda berhasil diubah');
        return redirect('user/profile');
    }
}
