<div class="row mt-4">
    <div class="col-lg-6">
        <div style="border-radius: 15px">
            <table>
                <tr>
                    <td>
                        <img src="{{ asset('img/MPI.png') }}" style="width: 100px; height:50px;" alt="">
                    </td>
                    <td>
                        <h2 style="margin-left:10px; margin-top: 0px; margin-bottom: 0px;">
                            PT. Megah Pita Indonesia
                        </h2>
                        <p style="margin-left:10px; margin-top: 0px; margin-bottom: 0px;">
                            Jl. Indo Karya 4 No.7, Papanggo, Kec. Tj. Priok, Kota Jkt Utara, Daerah Khusus Ibukota Jakarta 14340
                        </p>
                    </td>
                </tr>
            </table>
            {{-- <div style="display: flex !important; flex-wrap: nowrap !important;">
                <div style="">
                </div>
                <div style=""> 
                </div>
            </div> --}}
            <div class="">
                <div class="">
                    
                </div>
                <hr>
                <span class="fw-bold" style="font-size: 16px">Tanggal Dibuat: {{date('d/m/Y', strtotime($tanggal_kirim[0]))}}</span>
                <br>
                <span class="fw-bold" style="font-size: 16px">Email : {{($email ?? 'N/A')}}</span>
                <br>
                <span class="fw-bold" style="font-size: 16px">Status :  {{($status)}}</span>
                <br>
                <span class="fw-bold" style="font-size: 16px">No Faktur Pajak : {{($no_faktur ?? 'N/A')}}</span>
                <br>
                <span class="fw-bold" style="font-size: 16px">Total : Rp.{{($total ?? 'N/A')}}</span>
                <br>
                <span class="fw-bold" style="font-size: 16px">Note : {{($description ?? 'N/A')}}</span>
                <br><br>
            </div>
        </div>
    </div>
</div>

<div class="card" style="border-radius:15px;">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table  table-hover mb-0" id="HistoryTable" style="">
                <thead style="">
                    <tr>
                        <th style="padding-right: 30px !important; text-align:left !important;">NO</th>
                        <th style="padding-right: 30px !important; text-align:left !important;">No Po</th>
                        <th style="padding-right: 30px !important; text-align:left !important;">Tanggal Po</th>
                        <th style="padding-right: 30px !important; text-align:left !important;">No Invoice</th>
                        <th style="padding-right: 30px !important; text-align:left !important;">Tanggal Kirim</th>
                        {{-- <th style="padding-right: 30px !important; text-align:left !important;">Jumlah</th> --}}
                    </tr>
                </thead>
                    <tbody style="">
                        @foreach ($no_po as $key => $np) 
                            <tr>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                    {{ $loop->iteration }}
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                    {{$no_po[$key]}}
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                    {{$tanggal_po[$key]}}
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                    {{$no_invoice[$key]}}
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                    {{$tanggal_kirim[$key]}}
                                </td>
                                {{-- <td style="padding-right: 30px !important; text-align:left !important;">
                                    {{$total ?? ''}}
                                </td> --}}
                            </tr>
                            @endforeach
                            {{-- <tr>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                   
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                    
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                    
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                    &nbsp; 
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                    &nbsp;
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                   
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                    
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                    
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                    
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                    Total : 
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                    Rp.200.000
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                   
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;" colspan="2">
                                    Pembayaran Ke :
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                   
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                    PPN 11%
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                    Rp.2.000.000
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                   
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;" colspan="2">
                                    BCA PT.MEGAH Indonesia
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                   
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                   
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;" colspan="2">
                                    AC.No.241,300,8,999
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                    
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                   &nbsp;
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">

                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">

                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                    
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                   &nbsp;
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">

                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">

                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                    
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                   
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">

                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">

                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                    
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                    Total Invoice : 
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                    Rp.300.000
                                </td>
                            </tr>
                    </tbody>
            </table>
        </div>
    </div>
</div>

<div class="">
    <table>
        <tr>
            <td>
                <p style="margin-left:20px; margin-top: 10px; margin-bottom: 0px;">NOTE: SURAT JALAN,INVOICE</p>
            </td>
        </tr>
        <tr>
            <td>
                <p style="margin-left:465px; margin-top: 35px; margin-bottom: 0px;">Jakarta, {{ date('d F Y') }}</p>
                <p style="margin-left:465px; margin-top: 0px; margin-bottom: 0px;">Yang menerima,</p>
                <p style="margin-left:465px; margin-top: 60px; margin-bottom: 0px;">( <span style="margin-left: 170px;">)</span></p>
            </td>
        </tr>
    </table>
</div> --}}
