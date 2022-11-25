<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\VendorPivot;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Mail\FinanceEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;


class VendorController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'List Finance';
        $data['vendor'] = Vendor::get();

        return view('backend.vendor.index', $data);
    }

    public function checkAccr($ponum,$podate){
        $conn = curl_init();
        curl_setopt_array($conn, array(
            CURLOPT_URL => "http://megahpita.wiqi.co/api/index.php/Api/get/".$ponum."/".$podate."",// your preferred link
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($conn);
        $err = curl_error($conn);
        curl_close($conn);
        
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
           return json_decode($response);
        }
    }

    public function create  ()
    {
        $data['page_title'] = 'Tanda Terima';
        $data['vendor'] = Vendor::get();

        return view('backend.vendor.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            // 'no_po.*' => 'required',
            // 'tanggal_po.*' => 'required',
            'no_po' => 'required',
            'tanggal_po' => 'required',
            'no_invoice' => 'required',
            'tanggal_kirim' => 'required',
        ]);

        // foreach ($request->no_po as $key => $value) {
        //     $vendor = new Vendor();
        //     $vendor->tanggal_po = $request->tanggal_po[$key];
        //     $vendor->no_po = $request->no_po[$key];
        //     $vendor->no_inv_vendor = $request->no_inv[$key];
        //     // $vendor->tanggal_kirim = $request->tanggal_kirim[$key];
        //     $vendor->email = $request->email_vendor;
        //     $check = $this->checkAccr($request->no_po[$key],$request->tanggal_po[$key]);
        // }
        // if ($check){
        //     echo "success";
        //     // echo $check;
        //     return redirect()->route('backend.vendor.index')->with('success','Vendor created successfully');
        // }else{
        //     echo "Gagal Save";
        // }

        
            // $vendor = new Vendor();
            // $vendor->email = $request->email;
            // $vendor->description = $request->description;
            
            // // $vendorPivot = [];
            // // dd($vendor->id);
            // foreach ($request->no_po as $key => $value) {
                
            //     $vendorPivot[] = [
            //         'vendor_id' => $vendor->id,
            //         'no_po' => $request->no_po[$key],
            //         'tanggal_po' => $request->tanggal_po[$key],
            //         'no_invoice' => $request->no_invoice[$key],
            //         'tanggal_kirim' => $request->tanggal_kirim[$key],
            //         'created_at' => date('Y-m-d H:i:s'),
            //         'updated_at' => date('Y-m-d H:i:s')
            //     ];
            //     $check = $this->checkAccr($request->no_po[$key],$request->tanggal_po[$key]); //iniuntuk apa buat pengecekan data nya sama atau ngga sama yang di Api
            // }
            // // dd($check);
            // // VendorPivot::insert($vendorPivot);
            // if ($check){
            //     echo "success";
            //     // echo $check;
            //         $vendor->save();
            //         VendorPivot::insert($vendorPivot);
            //         return redirect()->route('backend.vendor.index')->with('success','Vendor created successfully');
            //     }else{
            //         echo "Gagal Save";
            //         return redirect()->route('backend.vendor.create')->with('failed','Data Is Not Competible');
            //     }
            // return redirect()->route('backend.forecast.index')->with(['success' => 'Data berhasil dibuat !']);

        DB::beginTransaction();
        try {
            
            $vendor = new Vendor();
            $vendor->email = $request->email;
            $vendor->description = $request->description;
            $vendor->save();
            // $vendorPivot = [];
            // dd($vendor->id);
            $vendorPivot = [];
            foreach ($request->no_po as $key => $value) {
                
                $check = $this->checkAccr($request->no_po[$key],$request->tanggal_po[$key]); //iniuntuk apa buat pengecekan data nya sama atau ngga sama yang di Api
                if ($check){
                    array_push($vendorPivot, [
                        'vendor_id' => $vendor->id,
                        'no_po' => $request->no_po[$key],
                        'tanggal_po' => $request->tanggal_po[$key],
                        'no_invoice' => $request->no_invoice[$key],
                        'tanggal_kirim' => $request->tanggal_kirim[$key],
                        'name' => $check[0]->VENDOR,  
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                }else{
                    DB::rollback();
                    return redirect()->route('vendor.create')->with('failed','Data Is Not Competible');
                }
            }
            dd($vendorPivot);
            // dd($vendorPivot);
            VendorPivot::insert($vendorPivot);
            DB::commit();
            return redirect()->route('vendor.create')->with('success','Vendor created successfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('vendor.create')->with('failed','Data Is Not Competible');
        }
    }

    public function edit($id)
    {
        $data['page_title'] = 'Edit List Finance';
        $data['vendor'] = Vendor::findOrFail($id);

        // dd($data['vendor']->vendorPivot());
        // $data['vendorpv'] = VendorPivot::findOrFail($id);

        return view('backend.vendor.edit', $data);
    }

    public function show($id)
    {
        $data['page_title'] = 'Show List FInance';
        $data['vendor'] = Vendor::findOrfail($id);
        $data['vendor_pivot'] = VendorPivot::get();

        return view('backend.vendor.show', $data);
    }


    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'no_po'   => 'required',
            'tanggal_po' => 'required',
            'no_invoice' => 'required',
            'tanggal_kirim' => 'required',
            'status' => 'required',
        ]);
        $check = $this->checkAccr('P2000023','04-21-2020');
        $vendor = Vendor::findOrFail($id);
        $vendor->email = $request->email;
        $vendor->status = $request->status;
        $vendor->description = $request->description;
        $vendor->total = $request->total;
        $vendor->no_faktur = $request->no_faktur;
        $vendor->save();

        // dd($purchaseOrder->purchaseOrderProduct);
        $vendor->vendorPivot()->delete();

        $vendorPivot = [];
        foreach ($request->no_po as $key => $value) {
            $getCheckAccr = $this->checkAccr($request->no_po[$key],$request->tanggal_po[$key]);
            $vendorPivot[] = [
                'vendor_id' => $vendor->id,
                'no_po' => $request->no_po[$key],
                'tanggal_po' => $request->tanggal_po[$key],
                'no_invoice' => $request->no_invoice[$key],
                'tanggal_kirim' => $request->tanggal_kirim[$key],
                'name' => $getCheckAccr[0]->VENDOR  
            ];
        }

        if ($vendor->status == 'Approve') {
            Mail::to($request->email)->send(new FinanceEmail($vendor));
        }
        VendorPivot::insert($vendorPivot);
        return redirect()->route('vendor.index')->with('success','List Finance Edit successfully');
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $employee = Vendor::findOrFail($id);
            $employee->delete();
        });
        
        Session::flash('success', 'Vendor deleted successfully!');
        return response()->json(['status' => '200']);
    }

    

    public function test(Request $request){
        $check = $this->checkAccr($request->po_no,$request->po_date);
        if ($check){
            echo "success";
            echo $check;
        }else{
            echo "Gagal Save";
        }
    }
    public function getData(){
        $conn = curl_init();
        curl_setopt_array($conn, array(
            CURLOPT_URL => "http://megahpita.wiqi.co/api/index.php/Api/get/P2000023/21.04.2020",// your preferred link
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($conn);
        $err = curl_error($conn);
        curl_close($conn);
        $decode = json_decode($response);
        // dd($response);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            // return (json_decode($response));
            return $decode[0];
        }
    }
}
