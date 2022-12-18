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
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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


        DB::beginTransaction();
        try {
            dd();
            $vendor = new Vendor();
            $vendor->email = $request->email;
            $vendor->description = $request->description;
            $vendor->save();
            // $vendorPivot = [];
            // dd($vendor->id);
            $vendorPivot = [];
            foreach ($request->no_po as $key => $value) {
                
                $check = $this->checkAccr($request->no_po[$key],$request->tanggal_po[$key]); //untuk pengecekan data nya sama atau ngga sama yang di Api
                if ($check){
                    array_push($vendorPivot, [
                        'vendor_id' => $vendor->id,
                        'no_po' => $request->no_po[$key],
                        'tanggal_po' => $request->tanggal_po[$key],
                        'no_invoice' => $request->no_invoice[$key],
                        'tanggal_kirim' => $request->tanggal_kirim[$key],
                        'name' => $check[0]->VENDOR,  
                        'amount' => $check[0]->AMOUNT,  
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                }else{
                    DB::rollback();
                    return redirect()->route('vendor.create')->with('failed','Data Is Not Competible');
                }
            }
            // dd($vendorPivot);
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

    public function attPdf($data){
        // dd($data);
        $pdf = Pdf::loadView('backend.vendor.pdf-show', $data);
        // return $pdf->download('invoice.pdf');
        Storage::put('public/Finance/List-Finance-'.$data['vendor']->no_faktur.'.pdf',$pdf->stream());
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'email'   => 'required',
            'status' => 'nullable',
            'description' => 'nullable',
            'total' => 'nullable',
            'no_faktur' => 'nullable',
            'no_po'   => 'required',
            'tanggal_po' => 'required',
            'no_invoice' => 'required',
            'tanggal_kirim' => 'required',
            'amount' => 'nullable'
        ]);

        $check = $this->checkAccr('P2000023','04-21-2020');
        $vendor = Vendor::findOrFail($id);
        $vendor->email = $request->email;
        $vendor->status = $request->status;
        $vendor->description = $request->description;
        $vendor->no_faktur = $request->no_faktur;
        $vendor->dibuat = $request->dibuat;
        $vendor->save();
       
        // dd($validateData);
        // Vendor::create($validateData);
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
                'amount' => $request->amount[$key],
                'name' => $getCheckAccr[0]->VENDOR    
                // 'amount' => $getCheckAccr[0]->AMOUNT  
            ];
        }

        VendorPivot::insert($vendorPivot);
        if ($vendor->status == 'Approve') { 
            // Untuk PDF
            $data['vendor'] = $vendor;
            $this->attPdf($data);
            
            // Untuk Kirim EMail
            Mail::to($request->email)->send(new FinanceEmail($vendor));
            Storage::delete('public/Finance/List-Finance-'.$vendor->no_faktur.'.pdf');
        }
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

    public function vendorExport($id)
    {
        $data['vendor']= Vendor::findOrfail($id);
        // dd($data['vendor']->vendorPivot, $data['vendor']);
        $pdf = Pdf::loadView('backend.vendor.pdf-show', $data);
        return $pdf->download('Finance-report.pdf');
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
