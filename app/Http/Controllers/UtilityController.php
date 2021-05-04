<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Helpers\MyHelper;
use App\Imports\WaybillsImport;
use App\Order;
use App\Product;
use App\Testimonial;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use League\Csv\Exception;
use League\Csv\Reader;
use SplFileInfo;
use Maatwebsite\Excel\Facades\Excel;

class UtilityController extends Controller
{
    public function show_form_import_csv_order_online()
    {
        return view('content.utility.import_csv_order_online', [
            'title' => 'Import Data Order Online'
        ]);
    }
    public function do_import_csv_order_online(Request $request)
    {
        // dd($request);
        $insertCount = $updateCount = $rowCount = $notAddCount = 0;
        if ($request->hasFile('file_order_csv')) {

            $filename = $_FILES['file_order_csv']['tmp_name'];
            $fileinfo = new SplFileInfo($filename);
            // $fileinfo = fopen($_FILES["file_order_csv"]["tmp_name"], 'r');;
            // $csv = array_map('str_getcsv', file($fileinfo->getRealPath()));
            try {
                $data = [];
                $product_id     = '';
                $user_id    = '';

                $csvFile = Reader::createFromPath($fileinfo->getRealPath(), 'r');
                $csvFile->setHeaderOffset(0);
                // $csvData = Statement::create()->process($csv);
                $csvData = $csvFile->getRecords();

                // validate if data is empty or null 
                if (!empty($csvData)) {

                    // insert to db
                    // foreach ($data as $key => $value) {
                    foreach ($csvData as $key => $value) {
                        $rowCount++;

                        $data_product   = [
                            'product_price' => $value['product_price'],
                            'cogs'  =>  $value['cogs'],
                        ];
                        // validasi product
                        // cari produk berdasarkan nama 
                        $product_exists = Product::where('product_name', $value['product'])->first();
                        // cek produk ada atau tidak
                        if ($product_exists) {
                            // kalo product ada, update product
                            Product::where('id', $product_exists->id)
                                ->update($data_product);
                            $product_id = $product_exists->id;
                        } else {
                            // kalo produk ngga ada tambahin
                            $data_product['product_name']   = $value['product'];
                            $product_id = Product::create($data_product)->id;
                        }
                        // prepare data user
                        $data_user = [
                            'name'      => $value['name'],
                            'email'     => $value['email'],
                            'password'  => password_hash(str_replace('+', '', $value['phone']), PASSWORD_DEFAULT),
                            'address'   => $value['address'],
                            'province'  => $value['province'],
                            'city'      => $value['city'],
                            'subdistrict'   => $value['subdistrict'],
                            'zip'       => $value['zip'],
                            'level'     => 0
                        ];
                        // validasi user exists berdasarkan no hp
                        $user_exists    = User::where('phone', str_replace('+', '', $value['phone']))->first();
                        if ($user_exists) {
                            User::where('id', $user_exists->id)
                                ->update($data_user);
                            $user_id    = $user_exists->id;
                        } else {
                            $data_user['phone'] = str_replace('+', '', $value['phone']);
                            $user_id    = User::create($data_user)->id;
                        }
                        // order
                        // prepare data
                        $data_order = [
                            'status' => $value['status'],
                            'payment_status' => $value['payment_status'],
                            'created_at' => $value['created_at'] ? MyHelper::formatDateToDb($value['created_at']) : null,
                            'processing_at' => $value['processing_at'] ? MyHelper::formatDateToDb($value['processing_at']) : null,
                            'completed_at' => $value['completed_at'] ? MyHelper::formatDateToDb($value['completed_at']) : null,
                            'paid_at' => $value['paid_at'] ? MyHelper::formatDateToDb($value['paid_at']) : null
                        ];
                        // validaso data order
                        // $order_exists = $this->order->findByOrderId($value['order_id']);
                        $order_exists   = Order::where('order_id', $value['order_id'])->first();
                        if (!$order_exists) {
                            // insert data order
                            $data_order['order_id'] = $value['order_id'];
                            $data_order['payment_method'] = $value['payment_method'];
                            $data_order['payment_info'] = $value['payment_info'];
                            $data_order['discount'] = $value['discount'];
                            $data_order['quantity'] = $value['quantity'];
                            $data_order['bump'] = $value['bump'];
                            $data_order['bump_price'] = $value['bump_price'];
                            $data_order['notes'] = $value['notes'];
                            $data_order['courier'] = $value['courier'];
                            $data_order['shipping_cost'] = $value['shipping_cost'];
                            $data_order['cod_cost'] = $value['cod_cost'];
                            $data_order['shipping_markup'] = $value['shipping_markup'];
                            $data_order['receipt_number'] = $value['receipt_number'];
                            $data_order['other_cost'] = $value['other_cost'];
                            $data_order['gross_revenue'] = $value['gross_revenue'];
                            $data_order['net_revenue'] = $value['net_revenue'];
                            $data_order['handled_by'] = $value['handled_by'];
                            $data_order['coupon'] = $value['coupon'];
                            $data_order['utm_campaign'] = $value['utm_campaign'];
                            $data_order['utm_medium'] = $value['utm_medium'];
                            $data_order['utm_source'] = $value['utm_source'];
                            $data_order['utm_content'] = $value['utm_content'];
                            $data_order['utm_term'] = $value['utm_term'];
                            $data_order['tags'] = $value['tags'];
                            $data_order['dropshipper_name'] = $value['dropshipper_name'];
                            $data_order['dropshipper_phone'] = $value['dropshipper_phone'];
                            $data_order['product_id']   = $product_id;
                            $data_order['user_id']   = $user_id;
                            $data_order['original_code']  = MyHelper::generateOriginalProductCode(8);
                            if (Order::create($data_order)) {
                                $insertCount++;
                            }
                        } else {
                            // update order
                            if (Order::where('id', $order_exists->id)->update($data)) {
                                $updateCount++;
                            }
                        }
                        if ($user_exists) {
                            $user = new User();
                            $product = new Product();
                            $stok = Order::where('user_id', $user_exists->id)->sum('quantity') * $product->product_per_box;
                            $level = $user_exists->level;
                            if ($stok >= $user->gold && $stok < $user->platinum) {
                                $level = 1;
                            } else if ($stok >= $user->platinum && $stok < $user->diamond) {
                                $level = 2;
                            } elseif ($stok >= $user->diamond) {
                                $level = 3;
                            } else {
                                $level = $level;
                            }
                            User::where('id', $user_exists->id)->update(['level' => $level]);
                        }
                    } //end foreach looping

                    // add counter
                    $notAddCount = $rowCount - ($insertCount + $updateCount);

                    // send message to user 
                    // $this->session->set_flashdata('success_message', "Import data success, Total Rows($rowCount) | Inserted ($insertCount) | Updated ($updateCount) | Not Inserted ($notAddCount)");
                    MyHelper::setMessage('Berhasil', 'success', "Import data sukses, Total Rows($rowCount) | Inserted ($insertCount)  | Not Inserted ($notAddCount)");
                    redirect('home');
                } else {
                    // $this->session->set_flashdata('error_message', 'File is empty, nothing imported');
                    MyHelper::setMessage('Gagal', 'error', 'File is empty, nothing imported');
                }
            } catch (Exception $e) {
                // $this->session->set_flashdata('error_message', "$e->getMessage()");
                // echo $e->getMessage(), PHP_EOL;
                MyHelper::setMessage('Gagal', 'error', "$e->getMessage()");
            }
            return back();
        }
    }
    public function show_form_import_resi()
    {
        return view('content.utility.import_resi', [
            'title' => 'Import Data Resi'
        ]);
    }
    public function do_import_resi(Request $request)
    {
        // dd($request->hasFile('file_resi'));
        if ($request->hasFile('file_resi')) {
            $this->validate($request, [
                'file_resi' => 'required|mimes:csv,xls,xlsx'
            ]);
            $validator =  Validator::make($request->all(), [
                'file_resi' => 'required|mimes:csv,xls,xlsx',
            ], [
                'required'  => 'Tidak ada file yang dipilih',
                'mimes'     => 'File harus berformat .CSV / .XLS / XLSX'
            ]);
            if ($validator->fails()) {
                MyHelper::setMessage('Oooppsss', 'error', $validator->errors()->first());
                return back();
            }
            Excel::import(new WaybillsImport, request()->file('file_resi'));
            MyHelper::setMessage('Berhasil', 'success', "Import data resi sukses");
            return back();
        } else {
            MyHelper::setMessage('Peringatan', 'warning', 'Tidak ada file yang dipilih');
            return back();
        }
    }

    public function show_form_upload_testimoni()
    {
        return view('content.utility.upload_testimoni', [
            'title' => 'Upload Testimoni'
        ]);
    }
    public function do_upload_testimoni(Request $request)
    {
        $path = 'public/images';
        $picname = '';
        if (!$request->user_id) {
            return back();
        }
        $validator  = Validator::make($request->all(), [
            'title'  => 'required',
            'content' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect('utility/upload_testimoni')->withErrors($validator)->withInput();
        }
        if ($request->hasFile('testimonial_picture')) {
            $validator =  Validator::make($request->all(), [
                'testimonial_picture' => 'image|mimes:jpeg,png,jpg|max:512',
            ], MyHelper::getUploadImageErrorMessage());
            if ($validator->fails()) {
                MyHelper::setMessage('Oooppsss', 'error', $validator->errors()->first());
                return back();
            }
            $image = $request->file('testimonial_picture');
            $img_ext = $image->getClientOriginalExtension();
            $img_name = sha1(crypt('reseller-image' . date('sisisi'), '')) . '.' . $img_ext;
            Storage::putFileAs($path, $request->file('testimonial_picture'), $img_name);
            $picname = $img_name;
        }
        $testimonial = new Testimonial;
        $testimonial->user_id = $request->user_id;
        $testimonial->title = $request->title;
        $testimonial->content = $request->content;
        $testimonial->picture = $picname;
        $testimonial->link = $request->link;
        $testimonial->save();
        MyHelper::setMessage('Berhasil!', 'success', 'Testimoni berhasil di upload!');
        return back();
    }
}
