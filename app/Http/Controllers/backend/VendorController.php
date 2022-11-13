<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\VendorPivot;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class VendorController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Vendor List';
        $data['vendor'] = Vendor::get();

        return view('backend.vendor.index', $data);
    }

    function checkAccr($ponum,$podate){
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

    public function create()
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

        
            $vendor = new Vendor();
            $vendor->email = $request->email;
            $vendor->description = $request->description;
            
            $vendorPivot = [];
            foreach ($request->no_po as $key => $value) {

                $vendorPivot[] = [
                    'vendor_id' => $vendor->id,
                    'no_po' => $request->no_po[$key],
                    'tanggal_po' => $request->tanggal_po[$key],
                    'no_invoice' => $request->no_invoice[$key],
                    'tanggal_kirim' => $request->tanggal_kirim[$key],
                    
                ];
            }
            $check = $this->checkAccr($request->no_po[$key],$request->tanggal_po[$key]);
            
            if ($check){
                echo "success";
                // echo $check;
                    $vendor->save();
                    VendorPivot::insert($vendorPivot);
                    return redirect()->route('backend.vendor.index')->with('success','Vendor created successfully');
                }else{
                    echo "Gagal Save";
                    return redirect()->route('backend.vendor.create')->with('failed','Data Is Not Competible');
                }
            // return redirect()->route('backend.forecast.index')->with(['success' => 'Data berhasil dibuat !']);

        //$vendor->save();

    }

    public function edit($id)
    {
        $data['page_title'] = 'Edit Vendor';
        $data['breadcumb'] = 'Edit Vendor';
        $data['vendor'] = Vendor::findOrFail($id);

        return view('backend.vendor.edit', $data);
    }

    public function show(){
        
    }


    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'nik'   => 'nullable',
            'description' => 'nullable',
        ]);

        $vendor = Vendor::findOrFail($id);
        $vendor->tanggal_po = $request->tanggal_po;
        $vendor->no_po = $request->no_po;
        $vendor->no_inv_vendor = $request->no_inv_vendor;
        $vendor->tanggal_kirim = $request->tanggal_kirim;
        $vendor->email = $request->email_vendor;
        
        $vendor->save();

        return redirect()->route('backend.vendor.index')->with(['success' => 'vendor edited successfully!']);
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
    // public function getData(){
    //     $conn = curl_init();
    //     curl_setopt_array($conn, array(
    //         CURLOPT_URL => "http://megahpita.wiqi.co/api/index.php/Api/get/P2000023/21.04.2020",// your preferred link
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => "",
    //         CURLOPT_TIMEOUT => 30000,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => "GET",
    //         CURLOPT_HTTPHEADER => array(
    //             // Set Here Your Requesred Headers
    //             'Content-Type: application/json',
    //         ),
    //     ));
    //     $response = curl_exec($conn);
    //     $err = curl_error($conn);
    //     curl_close($conn);
    //     $decode = json_decode($response);
    //     if ($err) {
    //         echo "cURL Error #:" . $err;
    //     } else {
    //         // return (json_decode($response));
    //         return $decode[0];
    //     }
    // }
}
