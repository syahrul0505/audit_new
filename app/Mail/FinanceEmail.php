<?php

namespace App\Mail;

use App\Models\Vendor;
use App\Models\VendorPivot;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;
 

class FinanceEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     public $data;

    public function __construct($data)
    {
        $this->data= $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // dd($this->data);
        $data = Vendor::get();
        // $data = VendorPivot::get();
        // dd($this->data->email);
        // dd($this->data);
        // dd($this->data['no_faktur']);
        // $temp['data'] = $this->data;
        // $pdf = Pdf::loadView('backend.vendor.pdf',$temp);
        // return $pdf->download('invoice.pdf');
        
        return $this->from('teamngeskuy5@gmail.com')
        ->subject('Finance - PT Megah Pita Indonesia')
        ->attach(asset('storage/Finance/List-Finance-'.$this->data['no_faktur'].'.pdf'), [
            'as' => 'List-Finance-'.$this->data['no_faktur'].'.pdf',
            'mime' => 'application/pdf',
        ])
        ->view('backend.vendor.email');
    }

    
}
